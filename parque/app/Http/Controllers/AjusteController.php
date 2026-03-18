<?php

namespace App\Http\Controllers;
use App\Models\Ajuste;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AjusteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ajuste = Ajuste::first();
        
        return view('admin.ajustes.index', compact('ajuste'));
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
        $ajuste = Ajuste::first();
        //return response()->json($request->all());
        $rules = [
            'nome' => 'required|string|max:255',
            'descricao' => 'required|string',
            'filial' => 'required|string|max:255',
            'direcao' => 'required|string',
            'telefone' => 'required|string|max:255',
            'divisa' => 'required|string|in:KZ,USD,EUR',
            'correio' => 'required|string|max:255',
            'pagina_web' => 'nullable|url|max:255',
        ];

        if(!$ajuste || !$ajuste->logo){
            $rules['logo'] = 'required|image|mimes:jpeg,jpg,png,svg,gif|max:2048';
        }else{
            $rules['logo'] = 'nullable|image|mimes:jpeg,jpg,png,svg,gif|max:2048';
        }
        if(!$ajuste || !$ajuste->logo_auto){
            $rules['logo_auto'] = 'required|image|mimes:jpeg,jpg,png,svg,gif|max:2048';
        }else{
            $rules['logo_auto'] = 'nullable|image|mimes:jpeg,jpg,png,svg,gif|max:2048';
        }
        $request -> validate($rules);
        
        if(!$ajuste){
            $ajuste = new Ajuste();
        }
        $ajuste->nome = $request->nome;
        $ajuste->descricao = $request->descricao;
        $ajuste->filial = $request->filial;
        $ajuste->direcao = $request->direcao;
        $ajuste->telefone = $request->telefone;
        $ajuste->divisa = $request->divisa;
        $ajuste->correio = $request->correio;
        $ajuste->pagina_web = $request->pagina_web;

        //guardar Logotipo
        if($request->hasFile('logo')){
            if($ajuste->logo && Storage::disk('public')->exists('logos/'.$ajuste->logo)){
                Storage::disk('public')->delete('logos/'.$ajuste->logo);
            }
            $logoPath = $request->file('logo')->store('logos','public');
            $ajuste->logo = basename($logoPath);
        }
         //guardar Logotipo_auto
        if($request->hasFile('logo_auto')){
            if($ajuste->logo_auto && Storage::disk('public')->exists('logos/'.$ajuste->logo_auto)){
                Storage::disk('public')->delete('logos/'.$ajuste->logo);
            }
            $logoAutoPath = $request->file('logo_auto')->store('logos','public');
            $ajuste->logo_auto = basename($logoAutoPath);
        }
        $ajuste->save();

        return redirect()->back()
        ->with('mensagem','Ajustes criado com sucesso')
        ->with('icon', 'success');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ajuste $ajuste)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ajuste $ajuste)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ajuste $ajuste)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ajuste $ajuste)
    {
        //
    }
}
