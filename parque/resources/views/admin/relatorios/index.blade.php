@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Centro de Relatórios do Sistema</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/relatorios')}}">Centro de Relatórios</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<hr>

@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-primary ">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calendar-day"></i><b> Relatório Semanal </b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('admin/relatorios/semanal')}}" method="get">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Data de Inicio</label>
                                <input type="date" name="data_inicio" class="form-control" value="{{ \Carbon\Carbon::now()->startOfWeek()->format('Y-m-d')}}" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Data Final</label>
                                <input type="date" name="data_final" class="form-control" value="{{ \Carbon\Carbon::now()->endOfWeek()->format('Y-m-d')}}" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-calendar-day"></i> Gerar Relatório</button>
                </form>
                
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    <div class="col-md-6">
        <div class="card card-success ">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-calendar-week"></i><b> Relatório Mensal </b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('admin/relatorios/mensal')}}" method="get">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"> 
                                <label for="">Ano</label>
                                <select name="year" class="form-control" required>
                                    @for($i = 2020; $i <= date('Y'); $i++)
                                    <option value="{{$i}}" @if($i == date('Y')) selected @endif>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Mês</label>
                                <select name="mes" class="form-control" required>
                                    @php 
                                    $currentMonth = date('n');
                                    $meses = [
                                    1 => 'Janeiro',
                                    2 => 'Fevereiro',
                                    3 => 'Março',
                                    4 => 'Abril',
                                    5 => 'Maio',
                                    6 => 'junho',
                                    7 => 'Julho',
                                    8 => 'Agosto',
                                    9 => 'Setembro',
                                    10 => 'Outubro',
                                    11 => 'Novembro',
                                    12 => 'Dezembro',
                                    ];
                                    @endphp                                    
                                     @for($i = 1; $i <= 12; $i++)
                                        <option value="{{$i}}" 
                                            @if($i == $currentMonth) selected @endif>
                                            {{$meses[$i]}}
                                        </option>
                                    @endfor
                                </select>                                
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-calendar-day"></i> Gerar Relatório</button>               </form>
                
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@stop

@section('css')
{{-- Add here extra stylesheets --}}
{{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
<script>
console.log("Hi, I'm using the Laravel-AdminLTE package!");
</script>
@stop