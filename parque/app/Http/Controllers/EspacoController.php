<?php

namespace App\Http\Controllers;

use App\Models\Ajuste;
use App\Models\Espaco;
use Illuminate\Http\Request;

class EspacoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ajuste = Ajuste::first();
        $espacos = Espaco::all();
        return view('admin.espacos.index', compact('espacos','ajuste'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.espacos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());
        $request -> validate([
            'numero' => 'required|unique:espacos',
            'estado' =>  'required',
        ]);

        $espaco = new Espaco();
        $espaco->numero = $request->numero;
        $espaco->estado = $request->estado;

        $espaco->save();

        return redirect()->route('admin.espacos.index')
        ->with('mensagem','Espaço registado com sucesso.')
        ->with('icon', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Espaco $espaco)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Espaco $espaco)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $espaco  = Espaco::find($id);
        $espaco->estado = $request->estado;
        $espaco -> save();

        return redirect()->route('admin.espacos.index')
        ->with('mensagem','Espaço modifiado com sucesso.')
        ->with('icon', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Espaco $espaco)
    {
        //
    }
}
