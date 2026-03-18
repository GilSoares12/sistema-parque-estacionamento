<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Mail\RegistroUsuarioMail;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::whereDoesntHave('roles', function($query){
            $query->where('name','SUPER ADMIN');
        })->withTrashed()->get();
        return view ('admin.usuarios.index', compact('usuarios'));
    }

    public function perfil(){
        $roles = Role::all();
        $usuario = User::find(Auth::user()->id);
        return view('admin.usuarios.perfil', compact('roles','usuario'));
    }

    public function atualizar_perfil(Request $request){

    //return response()->json($request->all());

    $usuario = User::find($request->id);

        $request -> validate([          
            'nomes' =>  'required|string|max:255',
            'apelidos' =>  'required|string|max:255',
            'email' =>  'required|string|email|max:255|unique:users,email,'.$request->id,
            'tipo_documento' =>  'required|in:BI,Passaporte',
            'numero_documento' =>  'required|string|max:14|unique:users,numero_documento,'.$request->id,
            'celular' =>  'required|string|max:9',
            'data_nascimento' =>  'required|string|date',
            'genero' =>  'required|in:Masculino,Femenino,Outro',
            'direcao' =>  'required|string|max:255',
            'contacto_nome' =>  'required|string|max:255',
            'contacto_telefone' =>  'required|string|max:9',
            'contacto_parentesco' =>  'required|string|max:100',
            'foto' =>  'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'password_atual' =>  'nullable|string',            
            'password_nova' =>  'nullable|string|min:8|required_with:password_atual',            
            'password_confirmacao' =>  'nullable|string|same:password_nova|required_with:password_nova',                        
            
        ]);

        //guardar Logotipo
        if($request->hasFile('foto')){
            if($usuario->foto && Storage::disk('public')->exists('fotos/'.$usuario->foto)){
                Storage::disk('public')->delete('fotos/'.$usuario->foto);
            }
            $fotoPath = $request->file('foto')->store('fotos','public');
            $usuario->foto = basename($fotoPath);
        }

        if($request->filled('password_atual')){
            if(!password_verify($request->password_atual, $usuario->password)){
                return redirect()->back()
                ->with('mensagem','A senha atual é incorreta.')
                ->with('icon', 'error');
            }else{
                $usuario->password = $request->password_nova;
            }
        }

        
        $usuario ->name = $request->nomes .' '. $request->apelidos;
        $usuario ->email = $request->email; 
        $usuario ->nomes = $request->nomes;
        $usuario ->apelidos = $request->apelidos;
        $usuario ->tipo_documento = $request->tipo_documento;
        $usuario ->numero_documento = $request->numero_documento;
        $usuario ->celular = $request->celular;
        $usuario ->data_nascimento = $request->data_nascimento;
        $usuario ->genero = $request->genero;
        $usuario ->direcao = $request->direcao;
        $usuario ->contacto_nome = $request->contacto_nome;
        $usuario ->contacto_telefone = $request->contacto_telefone;
        $usuario ->contacto_parentesco = $request->contacto_parentesco;

        $usuario->save();
        

        return redirect()->back()
        ->with('mensagem','Perfil atualizado com sucesso.')
        ->with('icon', 'success');
        
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());
        $request -> validate([
            'rol' => 'required',
            'email' =>  'required|string|email|max:255|unique:users',
            'nomes' =>  'required|string|max:255',
            'apelidos' =>  'required|string|max:255',
            'tipo_documento' =>  'required|in:BI,Passaporte',
            'numero_documento' =>  'required|string|max:14|unique:users',
            'celular' =>  'required|string|max:9',
            'data_nascimento' =>  'required|string|date',
            'genero' =>  'required|in:Masculino,Femenino,Outro',
            'direcao' =>  'required|string|max:255',
            'contacto_nome' =>  'required|string|max:255',
            'contacto_telefone' =>  'required|string|max:9',
            'contacto_parentesco' =>  'required|string|max:100',
            
        ]);

        $passwordTemporal = Str::random(8);

        $usuario = new User();
        $usuario ->name = $request->nomes .' '. $request->apelidos;
        $usuario ->email = $request->email;
        $usuario ->password = $passwordTemporal; 
        $usuario ->nomes = $request->nomes;
        $usuario ->apelidos = $request->apelidos;
        $usuario ->tipo_documento = $request->tipo_documento;
        $usuario ->numero_documento = $request->numero_documento;
        $usuario ->celular = $request->celular;
        $usuario ->data_nascimento = $request->data_nascimento;
        $usuario ->genero = $request->genero;
        $usuario ->direcao = $request->direcao;
        $usuario ->contacto_nome = $request->contacto_nome;
        $usuario ->contacto_telefone = $request->contacto_telefone;
        $usuario ->contacto_parentesco = $request->contacto_parentesco;

        $usuario->save(); 

        Mail::to($usuario->email)->send(new RegistroUsuarioMail($usuario, $passwordTemporal));

        $usuario->assignRole($request->rol);

        return redirect()->route('admin.usuarios.index')
        ->with('mensagem','Usuário registrado com sucesso e a senha enviada ao correio do usuário.')
        ->with('icon', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $usuario = User::find($id);
        return view('admin.usuarios.show', compact('usuario'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $usuario = User::find($id);
        $roles = Role::all();

        return view('admin.usuarios.edit', compact('usuario','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $usuario = User::find($id);
        $request -> validate([
            'rol' => 'required',
            'email' =>  'required|string|email|max:255|unique:users,email,'.$id,
            'nomes' =>  'required|string|max:255',
            'apelidos' =>  'required|string|max:255',
            'tipo_documento' =>  'required|in:BI,Passaporte',
            'numero_documento' =>  'required|string|max:14|unique:users,numero_documento,'.$id,
            'celular' =>  'required|string|max:9',
            'data_nascimento' =>  'required|string|date',
            'genero' =>  'required|in:Masculino,Femenino,Outro',
            'direcao' =>  'required|string|max:255',
            'contacto_nome' =>  'required|string|max:255',
            'contacto_telefone' =>  'required|string|max:9',
            'contacto_parentesco' =>  'required|string|max:100',
            
        ]);

        $usuario ->name = $request->nomes .' '. $request->apelidos;
        $usuario ->email = $request->email; 
        $usuario ->nomes = $request->nomes;
        $usuario ->apelidos = $request->apelidos;
        $usuario ->tipo_documento = $request->tipo_documento;
        $usuario ->numero_documento = $request->numero_documento;
        $usuario ->celular = $request->celular;
        $usuario ->data_nascimento = $request->data_nascimento;
        $usuario ->genero = $request->genero;
        $usuario ->direcao = $request->direcao;
        $usuario ->contacto_nome = $request->contacto_nome;
        $usuario ->contacto_telefone = $request->contacto_telefone;
        $usuario ->contacto_parentesco = $request->contacto_parentesco;

        $usuario->save();
        
        $usuario->syncRoles($request->rol);

        return redirect()->route('admin.usuarios.index')
        ->with('mensagem','Usuário atualizado com sucesso.')
        ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $usuario = User::find($id);
        

        //verificar que  não seja o  mesmo usuário Logado
        if($usuario->id === Auth::User()->id){
            return redirect()->back()
        ->with('mensagem','Não podes eliminar sua própria conta.')
        ->with('icon', 'error');
        }else
        {
            $usuario->estado = false;
            $usuario->save();

            $usuario->delete();
        return redirect()->route('admin.usuarios.index')
        ->with('mensagem','Usuário eliminado com sucesso.')
        ->with('icon', 'success');
        }        
    }
    public function restore($id){
        $usuario = User::withTrashed()->findOrFail($id);
        $usuario->restore();
        $usuario->estado = true;
        $usuario->save();      

        return redirect()->route('admin.usuarios.index')
        ->with('mensagem','Usuário restaurado com sucesso.')
        ->with('icon', 'success');
    }
}
