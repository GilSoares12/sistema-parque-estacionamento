<?php

namespace App\Http\Controllers;
use  App\Models\Ajuste;
use App\Models\Faturacao;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;

class FaturacaoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function imprimir_factura($id){
        $factura = Faturacao::find($id);
        $ajuste  = Ajuste::first();       

        $ficha_hora = Carbon::now();

        $pdf = PDF::loadView('admin.facturacao.factura_pdf', compact('factura','ajuste','ficha_hora'));

        //configuração d impressora térmica
        $pdf->setOptions([
            'dpi' => 120,
            'defaultPaperSize' => [0, 0, 226.77, 0],
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'Arial Narrow'
        ]);
        $pdf->setPaper([0, 0,  226.77, 999999]);

        return $pdf->stream("factura.pdf");

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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Faturacao $faturacao)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Faturacao $faturacao)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Faturacao $faturacao)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Faturacao $faturacao)
    {
        //
    }
}
