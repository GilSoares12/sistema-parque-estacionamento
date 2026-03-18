<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Ajuste;
use App\Models\Cliente;
use App\Models\Espaco;
use App\Models\Veiculo;
use App\Models\Tarifa;
use App\Models\Faturacao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use DateTime;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ajuste = Ajuste::first();
        $espacos = Espaco::all();
        $veiculos = Veiculo::with('cliente')->get();
        //$tarifas = Tarifa::all();
        $tarifas_ids = DB::table('tarifas')
        ->select(DB::raw('MIN(id) as id'))
        ->groupBy('nome','tipo')
        ->pluck('id');
        $tarifas = Tarifa::whereIn('id',$tarifas_ids)->get();

        $tickets_ativos = Ticket::where('estado_ticket', 'ativo')->get();
        //return response()->json($veiculos);
        return view('admin.tickets.index', compact('espacos','ajuste','veiculos','tarifas','tickets_ativos'));
    }

    public function buscar_veiculo($id){
        $veiculo = Veiculo::with('cliente')->find($id);
        return view('admin.tickets.buscar_veiculo', compact('veiculo'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function calcular_valor($id){

        $ticket = Ticket::find($id);
        $ajuste = Ajuste::first();

        $ficha_hora_ingresso = new DateTime($ticket->data_entrada ." ".$ticket->hora_entrada);
        $ficha_hora_saida = new DateTime(Carbon::now());

        $diff = $ficha_hora_ingresso->diff($ficha_hora_saida);
        $dias_calculado = $diff->days;
        $horas_calculado = $diff->h;
        $minutos_calculado = $diff->i;

        //Diferenºa por minutos
        $difrenca_minutos = ($diff->h * 60) + ($diff->i);

        $tempo_total = $dias_calculado. " dias com " .$horas_calculado." horas e ".$minutos_calculado." minutos ";

        if($dias_calculado > 0){
            $tarifa_id_minimo_por_dia = DB::table('tarifas')
            ->where('nome','regular')
            ->where('tipo','por_dia')
            ->min('id');
            $ticket->tarifa_id = $tarifa_id_minimo_por_dia;
            $ticket->save();
        }

        switch($ticket->tarifa->tipo){
            case 'por_hora':
                switch ($ticket->tarifa->nome){
                    case 'regular':
                    if( $minutos_calculado > $ticket->tarifa->minutos_de_graca){
                        $horas_calculado = $horas_calculado + 1;
                    }else{
                        $horas_calculado = $horas_calculado == 0 ? 1 : $horas_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_hora')->where('nome','regular')->where('quantidade',$horas_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'noturna':
                    if( $minutos_calculado > $ticket->tarifa->minutos_de_graca){
                        $horas_calculado = $horas_calculado + 1;
                    }else{
                        $horas_calculado = $horas_calculado == 0 ? 1 : $horas_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_hora')->where('nome','noturna')->where('quantidade',$horas_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'final_de_semana':
                    if( $minutos_calculado > $ticket->tarifa->minutos_de_graca){
                        $horas_calculado = $horas_calculado + 1;
                    }else{
                        $horas_calculado = $horas_calculado == 0 ? 1 : $horas_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_hora')->where('nome','final_de_semana')->where('quantidade',$horas_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'feriados':
                    if( $minutos_calculado > $ticket->tarifa->minutos_de_graca){
                        $horas_calculado = $horas_calculado + 1;
                    }else{
                        $horas_calculado = $horas_calculado == 0 ? 1 : $horas_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_hora')->where('nome','feriados')->where('quantidade',$horas_calculado)->first();
                    $valor_total = $tarifa->custo;

                    break;
                }
                break;

                case 'por_dia':
                switch ($ticket->tarifa->nome){
                    case 'regular':
                    if( $difrenca_minutos > $ticket->tarifa->minutos_de_graca){
                        $dias_calculado = $dias_calculado + 1;
                    }else{
                        $dias_calculado = $dias_calculado == 0 ? 1 : $dias_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_dia')->where('nome','regular')->where('quantidade',$dias_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'noturna':
                    if( $difrenca_minutos > $ticket->tarifa->minutos_de_graca){
                        $dias_calculado = $dias_calculado + 1;
                    }else{
                        $dias_calculado = $dias_calculado == 0 ? 1 : $dias_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_dia')->where('nome','noturna')->where('quantidade',$dias_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'final_de_semana':
                    if( $difrenca_minutos > $ticket->tarifa->minutos_de_graca){
                        $dias_calculado = $dias_calculado + 1;
                    }else{
                        $dias_calculado = $dias_calculado == 0 ? 1 : $dias_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_dia')->where('nome','final_de_semana')->where('quantidade',$dias_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'feriados':
                    if( $difrenca_minutos > $ticket->tarifa->minutos_de_graca){
                        $dias_calculado = $dias_calculado + 1;
                    }else{
                        $dias_calculado = $dias_calculado == 0 ? 1 : $dias_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_dia')->where('nome','feriados')->where('quantidade',$dias_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;
                }

                break;
        }
        echo $ajuste->divisa." ".$valor_total;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return response()->json($request->all());

         $request->validate([
            'espaco_id' => 'required',
            'veiculo_id' => 'required',
            'tarifa_id' => 'required',
        ]);

        $ticket_ativo = Ticket::where('veiculo_id', $request->veiculo_id)
                            ->where('estado_ticket','ativo')->first();
        if($ticket_ativo){
             return redirect()->back()
        ->with('mensagem','Erro: O veículo já tem um ticket ativo')
        ->with('icon', 'error');
        }

        

        $veiculo = Veiculo::find($request->veiculo_id);

        $ticket = new Ticket();
        $ticket->espaco_id = $request->espaco_id;
        $ticket->cliente_id = $veiculo->cliente->id;
        $ticket->veiculo_id = $request->veiculo_id;
        $ticket->tarifa_id = $request->tarifa_id;
        $ticket->usuario_id = Auth::user()->id;

        //gerar codigo d ticket
        $ultimo_ticket = DB::table('tickets')->max('id');
        $seguinte_ticket = $ultimo_ticket ? $ultimo_ticket + 1:1;
        $codigo_ticket = 'TK-'.$seguinte_ticket;

        //Adicionar a data e a hora
        $ficha_hora = Carbon::now();

        $ticket->codigo_ticket = $codigo_ticket;
        $ticket->data_entrada = $ficha_hora->toDateString();
        $ticket->hora_entrada = $ficha_hora->toTimeString();
        
        $ticket->estado_ticket = 'ativo';
        $ticket->obs = $request->obs;
        $ticket->save();

        return redirect()->route('admin.tickets.index')
        ->with('mensagem','Tickets registrado com sucesso')
        ->with('icon', 'success')
        ->with('ticket_id', $ticket->id);
    }

    public function atualizar_tarifa(Request $request){
        //return response()->json($request->all());

         $request->validate([
            'ticket_id_editar_tarifa' => 'required',
            'tarifa_id' => 'required',
        ]);
        $ticket = Ticket::find($request->ticket_id_editar_tarifa);
        $ticket->tarifa_id = $request->tarifa_id;
        $ticket->save();

        return redirect()->route('admin.tickets.index')
        ->with('mensagem','Tarifa atualizada com sucesso')
        ->with('icon', 'success');

    }

    public function imprimir_ticket($id){
        
        $ticket = Ticket::with('cliente')->find($id);
        $ajuste  = Ajuste::first();       

        $ficha_hora = Carbon::now();

        $pdf = PDF::loadView('admin.tickets.ticket_pdf', compact('ticket','ajuste','ficha_hora'));

        //configuração d impressora térmica
        $pdf->setOptions([
            'dpi' => 120,
            'defaultPaperSize' => [0, 0, 226.77, 0],
            'isHtml5ParserEnabled' => true,
            'isRemoteEnabled' => true,
            'defaultFont' => 'Arial Narrow'
        ]);
        $pdf->setPaper([0, 0,  226.77, 999999]);

        return $pdf->stream("ticket.pdf");

    }

    public function finalizar_ticket($id){
        $ticket = Ticket::find($id);

        $ficha_hora_ingresso = new DateTime($ticket->data_entrada ." ".$ticket->hora_entrada);
        $ficha_hora_saida = new DateTime(Carbon::now());

        $diff = $ficha_hora_ingresso->diff($ficha_hora_saida);
        $dias_calculado = $diff->days;
        $horas_calculado = $diff->h;
        $minutos_calculado = $diff->i;

        //Diferenºa por minutos
        $difrenca_minutos = ($diff->h * 60) + ($diff->i);

        $tempo_total = $dias_calculado. " dias com " .$horas_calculado." horas e ".$minutos_calculado." minutos ";

        if($dias_calculado > 0){
            $tarifa_id_minimo_por_dia = DB::table('tarifas')
            ->where('nome','regular')
            ->where('tipo','por_dia')
            ->min('id');
            $ticket->tarifa_id = $tarifa_id_minimo_por_dia;
            $ticket->save();
        }

        switch($ticket->tarifa->tipo){
            case 'por_hora':
                switch ($ticket->tarifa->nome){
                    case 'regular':
                    if( $minutos_calculado > $ticket->tarifa->minutos_de_graca){
                        $horas_calculado = $horas_calculado + 1;
                    }else{
                        $horas_calculado = $horas_calculado == 0 ? 1 : $horas_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_hora')->where('nome','regular')->where('quantidade',$horas_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'noturna':
                    if( $minutos_calculado > $ticket->tarifa->minutos_de_graca){
                        $horas_calculado = $horas_calculado + 1;
                    }else{
                        $horas_calculado = $horas_calculado == 0 ? 1 : $horas_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_hora')->where('nome','noturna')->where('quantidade',$horas_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'final_de_semana':
                    if( $minutos_calculado > $ticket->tarifa->minutos_de_graca){
                        $horas_calculado = $horas_calculado + 1;
                    }else{
                        $horas_calculado = $horas_calculado == 0 ? 1 : $horas_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_hora')->where('nome','final_de_semana')->where('quantidade',$horas_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'feriados':
                    if( $minutos_calculado > $ticket->tarifa->minutos_de_graca){
                        $horas_calculado = $horas_calculado + 1;
                    }else{
                        $horas_calculado = $horas_calculado == 0 ? 1 : $horas_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_hora')->where('nome','feriados')->where('quantidade',$horas_calculado)->first();
                    $valor_total = $tarifa->custo;

                    break;
                }
                break;

                case 'por_dia':
                switch ($ticket->tarifa->nome){
                    case 'regular':
                    if( $difrenca_minutos > $ticket->tarifa->minutos_de_graca){
                        $dias_calculado = $dias_calculado + 1;
                    }else{
                        $dias_calculado = $dias_calculado == 0 ? 1 : $dias_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_dia')->where('nome','regular')->where('quantidade',$dias_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'noturna':
                    if( $difrenca_minutos > $ticket->tarifa->minutos_de_graca){
                        $dias_calculado = $dias_calculado + 1;
                    }else{
                        $dias_calculado = $dias_calculado == 0 ? 1 : $dias_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_dia')->where('nome','noturna')->where('quantidade',$dias_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'final_de_semana':
                    if( $difrenca_minutos > $ticket->tarifa->minutos_de_graca){
                        $dias_calculado = $dias_calculado + 1;
                    }else{
                        $dias_calculado = $dias_calculado == 0 ? 1 : $dias_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_dia')->where('nome','final_de_semana')->where('quantidade',$dias_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;

                    case 'feriados':
                    if( $difrenca_minutos > $ticket->tarifa->minutos_de_graca){
                        $dias_calculado = $dias_calculado + 1;
                    }else{
                        $dias_calculado = $dias_calculado == 0 ? 1 : $dias_calculado;
                    }
                    $tarifa = Tarifa::where('tipo','por_dia')->where('nome','feriados')->where('quantidade',$dias_calculado)->first();
                    $valor_total = $tarifa->custo;
                    break;
                }

                break;
        }

        //atualizar ticket no banco de dados

        $ficha_hora = Carbon::now();
        $ticket->tarifa_id = $tarifa->id;
        $ticket->data_saida = $ficha_hora->toDateString();
        $ticket->hora_saida = $ficha_hora->toTimeString();
        $ticket->tempo_total = $tempo_total; 
        $ticket->valor_total = $valor_total; 
        $ticket->estado_ticket = 'completado'; 
        $ticket->save(); 

        //registrar a factura
        $factura = new Faturacao();
        $factura->ticket_id = $ticket->id;
        $factura->usuario_id = Auth::user()->id;

        //numero de factura
        $ultima_factura = DB::table('faturacaos')->max('id');
        $seguinte_factura = $ultima_factura ? $ultima_factura + 1:1;
        $nro_factura = 'TK-'.$seguinte_factura;

        $factura->nro_factura = $ticket->id;
        $factura->nome_cliente = $ticket->cliente->nomes;
        $factura->nro_documento = $ticket->cliente->numero_documento;
        $factura->placa = $ticket->veiculo->placa;
        $factura->detalhe = "Serviço de parque de " .$tempo_total;
        $factura->valor_total = $valor_total;
        $factura->save();


        return redirect()->route('admin.tickets.index')
        ->with('mensagem','Tickets facturado com sucesso')
        ->with('icon', 'success')
        ->with('factura_id', $factura->id);




    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ticket $ticket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ticket $ticket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        $ticket = Ticket::find($id);
        $ticket->delete();
        return redirect()->route('admin.tickets.index')
        ->with('mensagem','Ticket cancelado com sucesso')
        ->with('icon', 'success');
    }
}
