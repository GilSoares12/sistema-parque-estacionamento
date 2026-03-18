@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Editar tarifa</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/tarifas')}}">Lista de tarifas</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<hr>

@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-success">
            <div class="card-header">
                <h3 class="card-title"><b>Preencher os campos do formulário</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('admin/tarifa/'.$tarifa->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nome">Nome da Tarifa</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-tag"></i>
                                        </span>
                                    </div>
                                    <select name="nome" class="form-control" id="nome" required>
                                        <option value="">Selecione uma Tarifa...</option>
                                        <option value="regular" {{old('nome',$tarifa->nome) == 'regular' ? 'selected' : ''}}>
                                            Tarifa Regular</option>
                                        <option value="noturna" {{old('nome',$tarifa->nome) == 'noturna' ? 'selected' : ''}}>
                                            Tarifa Noturna</option>
                                        <option value="final_de_semana"
                                            {{old('nome',$tarifa->nome) == 'final_de_semana' ? 'selected' : ''}}>Final de Semana
                                        </option>
                                        <option value="feriados" {{old('nome',$tarifa->nome) == 'feriados' ? 'selected' : ''}}>
                                            Feriados
                                        </option>
                                    </select>
                                </div>
                                @error('nome')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tipo">Tipo de Tarifa</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-clock"></i>
                                        </span>
                                    </div>
                                    <select name="tipo" class="form-control" id="tipo" required>
                                        <option value="">Selecione umaTipo...</option>
                                        <option value="por_hora" {{old('tipo',$tarifa->tipo) == 'por_hora' ? 'selected' : ''}}>
                                            Por Hora</option>
                                        <option value="por_dia" {{old('nome',$tarifa->tipo) == 'por_dia' ? 'selected' : ''}}>
                                            Por Dia</option>

                                    </select>
                                </div>
                                @error('tipo')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="quantidade">Quantidade</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-layer-group"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="quantidade" id="quantidade" 
                                        min="0" value="{{ old('quantidade',$tarifa->quantidade)}}" required>
                                </div>
                                @error('quantidade')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="custo">Custo</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-dollar-sign"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="custo" id="custo" step="0.01"
                                        min="0" value="{{ old('custo',$tarifa->custo)}}" required>
                                </div>
                                @error('custo')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                    <label for="minutos_de_graca">Minutos de Graça</label> <b> (*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-hourglass-half"></i>
                                            </span>
                                        </div>
                                        <input type="number" class="form-control" name="minutos_de_graca" id="minutos_de_graca"
                                        min="0"    value="{{ old('minutos_de_graca',$tarifa->minutos_de_graca)}}" required>
                                    </div>
                                    @error('minutos_de_graca')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href=" {{ url('/admin/tarifas')}}" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left"></i> Regressar</a>
                            <button class="btn btn-success"><i class="fas fa-save"></i> Guardar</button>
                        </div>
                    </div>
                </form>
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