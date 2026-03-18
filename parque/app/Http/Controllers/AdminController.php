<?php

namespace App\Http\Controllers;
use Spatie\Permission\Models\Role;
use App\Models\User;
use App\Models\Espaco;
use App\Models\Tarifa;
use App\Models\Cliente;
use App\Models\Veiculo;
use App\Models\Ticket;
use App\Models\Ajuste;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $ajuste = Ajuste::first();
        $total_roles = Role::count();
        $total_usuarios = User::whereDoesntHave('roles', function($query){
            $query->where('name','SUPER ADMIN');
        })->withTrashed()->count();

        $total_Espacos = Espaco::count();
        $total_espacos_livres = Espaco::where('estado','Livre')->count();
        $total_espacos_reservados = Espaco::where('estado','Reservado')->count();
        $total_espacos_ocupados = Espaco::where('estado','Ocupado')->count();
        $total_espacos_manutencao = Espaco::where('estado','Manutencao')->count();
        $total_tarifas = Tarifa::count();
        $total_clientes = Cliente::count();
        $total_veiculos = Veiculo::count();
        $total_tickets = Ticket::where('estado_ticket','ativo')->count();

        //calculo dos ingressos diarios
        $ingresso_hoje = Ticket::where('estado_ticket','completado')
        ->whereDate('data_saida', Carbon::today())
        ->sum('valor_total');

        $ingresso_ontem = Ticket::where('estado_ticket','completado')
        ->whereDate('data_saida', Carbon::yesterday())
        ->sum('valor_total');

        $ingresso_semanal = Ticket::where('estado_ticket','completado')
        ->whereBetween('data_saida', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
        ->sum('valor_total');

        $ingresso_semana_anterior = Ticket::where('estado_ticket','completado')
        ->whereBetween('data_saida', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
        ->sum('valor_total');

        $ingresso_este_mes = Ticket::where('estado_ticket','completado')
        ->whereMonth('data_saida', Carbon::now()->month)
        ->whereYear('data_saida', Carbon::now()->year)
        ->sum('valor_total');

        $ingresso_mes_anterior = Ticket::where('estado_ticket','completado')
        ->whereMonth('data_saida', Carbon::now()->subMonth()->month)
        ->whereYear('data_saida', Carbon::now()->subMonth()->year)
        ->sum('valor_total');

        $ingresso_total = Ticket::where('estado_ticket','completado')
        ->sum('valor_total');

        //calculoo de dados do gráfico
        $ingressos_mensais = Ticket::select(
            DB::raw('MONTH(data_saida) as mes'),
            DB::raw('SUM(valor_total) as total')
        )->where('estado_ticket','completado')
        ->groupBy('mes')
        ->orderBy('mes')
        ->get()
        ->keyBy('mes')
        ->toArray();

        $ingressos_data = array_fill(1, 12, 0);
        foreach($ingressos_mensais as $mes => $data){
            $ingressos_data[$mes] = $data['total'];
        }

        //calculo de paste para rastreamento
        $espacos = Espaco::all();
        $ticket_ativos = Ticket::where('estado_ticket','ativo')->get();

        //return response()->json($ingressos_data);
        return view('admin.index', compact('ajuste','total_roles','total_usuarios','total_Espacos','total_espacos_livres',
        'total_espacos_reservados', 'total_espacos_ocupados', 'total_espacos_manutencao','total_tarifas','total_clientes',
        'total_veiculos','total_tickets','ingresso_hoje','ingresso_ontem','ingresso_semanal','ingresso_semana_anterior',
        'ingresso_este_mes','ingresso_mes_anterior','ingresso_total','ingressos_mensais','ingressos_data','espacos',
        'ticket_ativos'));
    }
}
