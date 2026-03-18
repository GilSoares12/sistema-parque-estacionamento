@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">
                <h1><b>Seja Bem-Vindo: </b>{{Auth::user()->name}}</h1>
            </h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}"><b>Roles:
                            {{Auth::user()->roles->pluck('name')->implode(', ')}}</b></a> </li>
            </ol>
        </div><!-- /.col -->

    </div><!-- /.row -->
</div>
<hr>
@stop

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                @can('admin.roles.index')
                    <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box zoomP">
                        <span class="info-box-icon bg-info">
                            <a href=" {{url('/admin/roles')}} ">
                                <img src="{{url('/imagens/personnel.gif')}}" width="100%" alt="">
                            </a>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Roles registrados</span>
                            <span class="info-box-number">{{$total_roles}} Roles</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                @endcan
                
                @can('admin.usuarios.index')
                    <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box zoomP">
                        <span class="info-box-icon bg-info">
                            <a href=" {{url('/admin/usuarios')}} ">
                                <img src="{{url('/imagens/teamwork.gif')}}" width="100%" alt="">
                            </a>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Usuários registrados</span>
                            <span class="info-box-number">{{$total_usuarios}} Usuários</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                @endcan
                
                @can('admin.espacos.index')

                <div class="col-md-6 col-sm-6 col-12">
                    <div class="info-box zoomP">
                        <span class="info-box-icon bg-info">
                            <a href=" {{url('/admin/espacos')}} ">
                                <img src="{{url('/imagens/toll.gif')}}" width="100%" alt="">
                            </a>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">{{$total_Espacos}} Espaços registrados</span>
                            <span class="info-box-number" style="text-align:center;">{{$total_espacos_livres}} Livres |
                                {{$total_espacos_reservados}} Reservado(s) |
                                {{$total_espacos_ocupados}} Ocupado(s) | {{$total_espacos_manutencao}} em
                                Manutenção</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                @endcan

                

            </div>
            <div class="row">
                @can('admin.tarifas.index')
                    <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box zoomP">
                        <span class="info-box-icon bg-info">
                            <a href=" {{url('/admin/tarifas')}} ">
                                <img src="{{url('/imagens/money-bag.gif')}}" width="100%" alt="">
                            </a>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tarifas registradas</span>
                            <span class="info-box-number">{{$total_tarifas}} Tarifas</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                @endcan

                @can('admin.clientes.index')
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box zoomP">
                        <span class="info-box-icon bg-info">
                            <a href=" {{url('/admin/clientes')}} ">
                                <img src="{{url('/imagens/human-resources.gif')}}" width="100%" alt="">
                            </a>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Clientes registrados</span>
                            <span class="info-box-number">{{$total_clientes}} Clientes</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                @endcan

                @can('admin.veiculos.index')
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box zoomP">
                        <span class="info-box-icon bg-info">
                            <a href=" {{url('/admin/veiculos')}} ">
                                <img src="{{url('/imagens/car.gif')}}" width="100%" alt="">
                            </a>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Veículos registrados</span>
                            <span class="info-box-number">{{$total_veiculos}} Veículos</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                @endcan

                @can('admin.tickets.index')
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box zoomP">
                        <span class="info-box-icon bg-info">
                            <a href=" {{url('/admin/tickets')}} ">
                                <img src="{{url('/imagens/receipt.gif')}}" width="100%" alt="">
                            </a>
                        </span>

                        <div class="info-box-content">
                            <span class="info-box-text">Tickets ativos registrados</span>
                            <span class="info-box-number">{{$total_tickets}} Tickets</span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                @endcan

            </div>
            @can('admin.relatorios.index')

            <div class="row">
                <div class="col-md-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner" style="color:white;">
                            <h3>{{$ajuste->divisa." ".$ingresso_hoje}}</h3>

                            <p>Ingressos de Hoje</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>

                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-success">
                        <div class="inner" style="color:white;">
                            <h3>{{$ajuste->divisa." ".$ingresso_ontem}}</h3>

                            <p>Ingressos de Ontem</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>

                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner" style="color:white;">
                            <h3>{{$ajuste->divisa." ".$ingresso_semanal}}</h3>

                            <p>Ingressos da Semana</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>

                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-info">
                        <div class="inner" style="color:white;">
                            <h3>{{$ajuste->divisa." ".$ingresso_semana_anterior}}</h3>

                            <p>Ingressos da Semana Anterior</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner" style="color:white;">
                            <h3>{{$ajuste->divisa." ".$ingresso_este_mes}}</h3>

                            <p>Ingressos deste Mês</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-6">
                    <!-- small card -->
                    <div class="small-box bg-danger">
                        <div class="inner" style="color:white;">
                            <h3>{{$ajuste->divisa." ".$ingresso_mes_anterior}}</h3>

                            <p>Ingressos do Mês Anterior</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-calendar-day"></i>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-6">
                    <!-- small card -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{$ajuste->divisa." ".$ingresso_total}}</h3>

                            <p>Ingressos Total do Sistema</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill"></i>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-md-6">                    
                    <div class="card card-outline card-info ">
                        <div class="card-header">
                            <h3 class="card-title"><b>Ingressos Mensais</b></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <canvas id="ingressosMensais"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

                <div class="col-md-6">                    
                    <div class="card card-outline card-info ">
                        <div class="card-header">
                            <h3 class="card-title"><b>Estado de Rastreamento</b></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <canvas id="estadoEspacosPorTicket"></canvas>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>

            </div>

            @endcan

        </div>

        <div class="col-md-3">
            <h1 id="reloj-hora" class="text-center font-weight-bold"></h1>
            <h5 id="reloj-data" class="text-center"></h5>
            <div class="card card-outline card-primary ">
                <div class="card-header">
                    <h3 class="card-title"><b>Calendário</b></h3>

                    <!-- /.card-tools -->

                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="calendar" style="margin-top: -20px;"></div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>

        </div>

    </div>
</div>
@stop

@section('css')
<style>
.zoomP {
    transition: transform 0.3s ease;
    border: 1px solid #c0c0c0;
    box-shadow: #c0c0c0 0px 5px 5px 0px;
}

.zoomP:hover {
    transform: scale(1.05);
}
</style>

@stop

@section('js')
<!-- /.card-body -->
<script>
const ingressosData = @json(array_values($ingressos_data));
const ctx1 = document.getElementById("ingressosMensais").getContext('2d');
new Chart(ctx1, {
    type: 'line',
    data: {
        labels: ["Jan", "Fev", "Mar", "Abr", "Mai", "Jun", "Jul", "Ago", "Set", "Out", "Nov", "Dez"],
        datasets: [{
            label: 'Ingressos ($)',
            data: ingressosData,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});

<!-- Gráfico de pastel que faz o controlo dos espaços-->
@php
    $ticketsOcupado = 0;
    $espacoReservado = 0;
    $espacoLivre = 0;
    $espacoManutencao = 0;
@endphp

@foreach($espacos as $espaco)
    @php
        $ticket_ativo = $ticket_ativos->firstWhere('espaco_id',$espaco->id);
        if ($ticket_ativo){
            $ticketsOcupado++;
        }elseif($espaco->estado == "Livre"){
            $espacoLivre++;
        }elseif($espaco->estado == "Reservado"){
            $espacoReservado++;
        }elseif($espaco->estado == "Manutencao"){
            $espacoManutencao++;
        }
    @endphp
@endforeach

const ticketsOcupado = {{$ticketsOcupado}};
const espacoReservado = {{$espacoReservado}};
const espacoLivre = {{$espacoLivre}};
const espacoManutencao = {{$espacoManutencao}};

const ctxPie = document.getElementById("estadoEspacosPorTicket").getContext('2d');
new Chart(ctxPie, {
    type: 'pie',
    data: {
        labels: ['Ocupados', 'Reservado', 'Livre', 'Em Manutenção'],
        datasets: [{
            data: [ticketsOcupado, espacoReservado, espacoLivre, espacoManutencao],
            backgroundColor: ['#dc3545', '#2173f6','#28a745', '#ffc107'],
            haverOffset: 4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend:{
                position: 'top',
            }            
        }
    }
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const calendar = new VanillaCalendar('#calendar', {
        type: 'default',
        settings: {

            lang: 'pt',
            visibility: {
                theme: 'light'
            }
        },
        locale: {
            months: [
                'Janeiro', 'Fevereiro', 'MMarco', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
            ],
            weekday: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb']
        },
        actions: {
            clickDay(event, self) {
                console.log('Fecha seleccionada:', self.selectedDates[0]);
            }
        }
    });

    calendar.HTMLElement.style.width = '100%';
    calendar.HTMLElement.style.maxWidth = '100%';

    calendar.init();
});
</script>

<script>
function actualizarReloj() {
    const d = new Date();
    const dias = ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'];
    const meses = ['Janeiro', 'Fevereiro', 'MMarco', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro',
        'Novembro', 'Dezembro'
    ];

    const diaSemana = dias[d.getDay()];
    const dia = d.getDate();
    const mes = meses[d.getMonth()];
    const ano = d.getFullYear();

    let h = d.getHours();
    let m = d.getMinutes();
    let s = d.getSeconds();

    // Convertir a formato de 12 horas y determinar AM/PM
    let meridiano = h >= 12 ? 'PM' : 'AM';
    h = h % 12;
    h = h ? h : 12; // La hora '0' debe ser '12'

    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;

    document.getElementById('reloj-data').innerHTML = `${diaSemana}, ${dia} de ${mes} de ${ano}`;
    document.getElementById('reloj-hora').innerHTML = `${h}:${m}:${s} ${meridiano}`;
}

setInterval(actualizarReloj, 1000);
actualizarReloj();
</script>
@stop