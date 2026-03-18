<?php

namespace App\Http\Controllers;
use App\Models\Ajuste;
use App\Models\Tarifa;
use Illuminate\Http\Request;

class TarifaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ajuste = Ajuste::first();
        $tarifas = Tarifa::all();
        return view("admin.tarifas.index", compact('tarifas','ajuste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.tarifas.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());

        $request -> validate([
            'nome' =>  'required',
            'tipo' =>  'required',
            'quantidade' =>  'required',
            'custo' =>  'required',
            'minutos_de_graca' =>  'required',
            
        ]);
        $tarifa = new Tarifa();
        $tarifa->nome = $request->nome;
        $tarifa->tipo = $request->tipo;
        $tarifa->quantidade = $request->quantidade;
        $tarifa->custo = $request->custo;
        $tarifa->minutos_de_graca = $request->minutos_de_graca;

        $tarifa->save();

        return redirect()->route('admin.tarifas.index')
        ->with('mensagem','Tarifa registrada com sucesso')
        ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tarifa $tarifa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tarifa = Tarifa::find($id);
        return view('admin.tarifas.edit', compact('tarifa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //return response()->json($request->all());
        $tarifa = Tarifa::find($id);
        $request -> validate([
            'nome' =>  'required',
            'tipo' =>  'required',
            'quantidade' =>  'required',
            'custo' =>  'required',
            'minutos_de_graca' =>  'required',
            
        ]);

        $tarifa->nome = $request->nome;
        $tarifa->tipo = $request->tipo;
        $tarifa->quantidade = $request->quantidade;
        $tarifa->custo = $request->custo;
        $tarifa->minutos_de_graca = $request->minutos_de_graca;

        $tarifa->save();

        return redirect()->route('admin.tarifas.index')
        ->with('mensagem','Tarifa atualizadda com sucesso')
        ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tarifa = Tarifa::find($id);
        $tarifa->delete();

        return redirect()->route('admin.tarifas.index')
        ->with('mensagem','Tarifa eliminada com sucesso')
        ->with('icon', 'success');

    }
}
