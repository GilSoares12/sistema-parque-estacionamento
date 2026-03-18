<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::withTrashed()->get();
        return view('admin.clientes.index', compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());

         $request->validate([
            'nomes' => 'required',
            'numero_documento' => 'required',
            'email' => 'required',
            'contacto' => 'required',
            'genero' => 'required',
        ]);

        $cliente = new Cliente();
        $cliente->nomes = $request->nomes;
        $cliente->numero_documento = $request->numero_documento;
        $cliente->email = $request->email;
        $cliente->contacto = $request->contacto;
        $cliente->genero = $request->genero;
        $cliente->save();

        return redirect()->route('admin.clientes.index')
        ->with('mensagem','Cliente registrado com sucesso')
        ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $cliente = Cliente::with('veiculos')->find($id);
        return view('admin.clientes.show', compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {        
        $cliente = Cliente::find($id);
        return view('admin.clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //return response()->json($request->all());

        $cliente = Cliente::find($id);
        $request->validate([
            'nomes' => 'required',
            'numero_documento' => 'required',
            'email' => 'required',
            'contacto' => 'required',
            'tipo_cliente' => 'required',
            'genero' => 'required',
        ]);

        $cliente->nomes = $request->nomes;
        $cliente->numero_documento = $request->numero_documento;
        $cliente->email = $request->email;
        $cliente->contacto = $request->contacto;
        $cliente->tipo_cliente = $request->tipo_cliente;
        $cliente->genero = $request->genero;
        $cliente->save();

        return redirect()->route('admin.clientes.index')
        ->with('mensagem','Cliente editado com sucesso')
        ->with('icon', 'success');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente = Cliente::find($id);  

        $cliente->estado = false;
        $cliente->save();
        $cliente->delete();

        return redirect()->route('admin.clientes.index')
        ->with('mensagem','Cliente eliminado com sucesso.')
        ->with('icon', 'success');            
    }
    public function restore($id){
        $cliente = Cliente::withTrashed()->findOrFail($id);
        $cliente->restore();
        $cliente->estado = true;
        $cliente->save();      

        return redirect()->route('admin.clientes.index')
        ->with('mensagem','Cliente restaurado com sucesso.')
        ->with('icon', 'success');
    }
}
