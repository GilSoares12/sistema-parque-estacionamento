<?php

namespace App\Http\Controllers;
use App\Models\Faturacao;
use App\Models\Ajuste;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class RelatorioController extends Controller
{
    public function index(){
        return view('admin.relatorios.index');
    }
    public function relatorio_semanal( Request $request){
        $data_inicio = $request->input('data_inicio');
        $data_final = $request->input('data_final');
        $usuario = Auth::user();

        $facturacoes = Faturacao::whereBetween('created_at', [$data_inicio, $data_final])->get();
        $ajuste = Ajuste::first();

        $pdf = PDF::loadView('admin.relatorios.semanal', compact('facturacoes','ajuste','data_inicio', 'data_final','usuario'));
        return $pdf->stream("relatorio_semanal.pdf");

    }
    public function relatorio_mensal( Request $request){
        $year = $request->input('year');
        $mes = $request->input('mes');
        $usuario = Auth::user();

        $facturacoes = Faturacao::whereYear('created_at', $year)
        ->whereMonth('created_at', $mes)
        ->get();
        $ajuste = Ajuste::first();

        $pdf = PDF::loadView('admin.relatorios.mensal', compact('facturacoes','ajuste','year', 'mes','usuario'));
        return $pdf->stream("relatorio_semanal.pdf");

    }
}
