<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());

        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        $rol = new Role();
        $rol->name = strtoupper($request->name);
        $rol->save();

        return redirect()->route('admin.roles.index')
        ->with('mensagem','Rol registrado com sucesso')
        ->with('icon', 'success');
    }

    public function permissoes($id){
        $role = Role::find($id);
        $permissoes = Permission::all()->groupBy(function($permissao){
            if(stripos($permissao->name, 'ajuste') != false){return 'Ajustes';}
            if(stripos($permissao->name, 'role') != false){return 'Roles';}
            if(stripos($permissao->name, 'usuario') != false){return 'Usuários';}
            if(stripos($permissao->name, 'espaco') != false){return 'Espacos';}
            if(stripos($permissao->name, 'tarifa') != false){return 'tarifas';}
            if(stripos($permissao->name, 'cliente') != false){return 'Cliente';}
            if(stripos($permissao->name, 'veiculo') != false){return 'Veículos';}
            if(stripos($permissao->name, 'ticket') != false){return 'Tickets';}
            if(stripos($permissao->name, 'faturacao') != false){return 'Facturações';}
            if(stripos($permissao->name, 'relatorio') != false){return 'Relatórios';}

        });

         //return response()->json($permissoes);

        return view('admin.roles.permissoes', compact('role','permissoes'));

    }

    public function update_permissoes(Request $request, $id){
        $role = Role::find($id);
        $role->permissions()->sync($request->permissoes);

        return redirect()->route('admin.roles.index')
        ->with('mensagem','Permissões adicionadas com sucesso')
        ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $role = Role::find($id);
        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //return response()->json($request->all());
        $request -> validate([
            'name' =>  'required|string|max:255|unique:roles,name,'.$id,
        ]);
        $rol = Role::find($id);
        $rol->name = strtoupper($request->name);
        $rol->save();

        return redirect()->route('admin.roles.index')
        ->with('mensagem','Rol atualizado com sucesso')
        ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Role::find($id);
        $rol->delete();

        return redirect()->route('admin.roles.index')
        ->with('mensagem','Rol eliminado com sucesso')
        ->with('icon', 'success');

    }
}
