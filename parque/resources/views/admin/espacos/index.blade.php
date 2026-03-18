@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Lista de Espaços</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item active">Lista espaços</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<hr>

@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-outline card-primary ">
            <div class="card-header">
                <h3 class="card-title"><b>Espaços registrados</b></h3>

                <!-- /.card-tools -->
                <div class="card-tools">
                    <a href="{{url('/admin/espacos/create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Criar
                        novo</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    @foreach($espacos as $espaco)
                    <div class="col" style="text-align:center">
                        <h2>{{$espaco->numero}}</h2>

                        <button @if($espaco->estado == "Livre") class="btn btn-success" @endif
                            @if($espaco->estado == "Manutencao") class="btn btn-warning" @endif
                            @if($espaco->estado == "Reservado") class="btn btn-primary" @endif
                            @if($espaco->estado == "Ocupado") class="btn btn-danger" @endif data-toggle="modal"
                            data-target="#modal_mudar_estado{{$espaco->id}}">
                            <img src="{{ asset('storage/logos/'.$ajuste->logo_auto)}}" alt=""
                                style="max-width:100px; margin-top:10px;">
                        </button>
                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <div class="modal fade" id="modal_mudar_estado{{$espaco->id}}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header" style="background-color: #247124; color:white;">
                                        <h5 class="modal-title" id="exampleModalLabel">Mudar o estado do espaço {{$espaco->numero}}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{url('/admin/espaco/'.$espaco->id)}}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label for="estado">Estado do espaço</label> <b> (*)</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-check-circle"></i>
                                                            </span>
                                                        </div>
                                                        <select name="estado" class="form-control" id="estado" required>
                                                            <option value="">Selecione um estado...</option>
                                                            <option value="Livre"
                                                                {{old('estado') == 'Livre' ? 'selected' : ''}}>
                                                                Livre</option>
                                                                <option value="Reservado"
                                                                {{old('estado') == 'Reservado' ? 'selected' : ''}}>
                                                                Reservado</option>
                                                            <option value="Ocupado"
                                                                {{old('estado') == 'Ocupado' ? 'selected' : ''}}>
                                                                Ocupado</option>
                                                            <option value="Manutencao"
                                                                {{old('estado') == 'Manutencao' ? 'selected' : ''}}>
                                                                Manutenção
                                                            </option>
                                                        </select>
                                                    </div>
                                                    @error('estado')
                                                    <small style="color: red">{{$message}}</small>

                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Cancelar</button>
                                                    <button type="submit" class="btn btn-success">Guardar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <h5>{{$espaco->estado}}</h5>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@stop

@section('css')

@stop

@section('js')

@stop