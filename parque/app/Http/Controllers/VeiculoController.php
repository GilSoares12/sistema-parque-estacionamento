<?php

namespace App\Http\Controllers;

use App\Models\Veiculo;
use Illuminate\Http\Request;

class VeiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $veiculos = Veiculo::all();

        return view('admin.veiculos.index', compact('veiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //return response()->json($request->all());
         $request->validate([
            'cliente_id' => 'required',
            'placa' => 'required|unique:veiculos,placa',
            'marca' => 'required',
            'modelo' => 'required',
            'cor' => 'required',
            'tipo' => 'required',
        ]);

        $veiculo = new Veiculo();
        $veiculo->cliente_id = $request->cliente_id;
        $veiculo->placa = strtoupper($request->placa);
        $veiculo->marca = $request->marca;
        $veiculo->modelo = $request->modelo;
        $veiculo->cor = $request->cor;
        $veiculo->tipo = $request->tipo;
        
        $veiculo->save();

        return redirect()->back()
        ->with('mensagem','Veiculo registrado com sucesso')
        ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Veiculo $veiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Veiculo $veiculo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //return response()->json($request->all());

        $veiculo = Veiculo::find($id);

        $request->validate([
            'cliente_id' => 'required',
            'placa' =>  'required|string|max:255|unique:veiculos,placa,'.$id,
            'marca' => 'required',
            'modelo' => 'required',
            'cor' => 'required',
            'tipo' => 'required',
        ]);

       
        $veiculo->cliente_id = $request->cliente_id;
        $veiculo->placa = strtoupper($request->placa);
        $veiculo->marca = $request->marca;
        $veiculo->modelo = $request->modelo;
        $veiculo->cor = $request->cor;
        $veiculo->tipo = $request->tipo;
        
        $veiculo->save();

        return redirect()->back()
        ->with('mensagem','Veiculo atualizado com sucesso')
        ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $veiculo = Veiculo::find($id);
        $veiculo->delete();

        return redirect()->back()
        ->with('mensagem','Veiculo eliminado com sucesso')
        ->with('icon', 'success');
    }
}
