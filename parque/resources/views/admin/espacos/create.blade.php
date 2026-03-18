@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Registro de um novo espaço</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/espacos')}}">Lista de espaços</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<hr>

@stop

@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card card-primary ">
            <div class="card-header">
                <h3 class="card-title"><b>Preencher os campos do formulário</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('admin/espacos/create')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="numero">Numero do Espaço</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-parking"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="numero" value="{{ old('numero')}}"
                                        placeholder=" Ex: A1, A2" required>
                                </div>
                                @error('numero')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                    <label for="estado">Estado</label> <b> (*)</b>
                                    <div class="input-group mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-check-circle"></i>
                                            </span>
                                        </div>
                                        <select name="estado" class="form-control" id="estado" required>
                                        <option value="Livre" {{old('estado') == 'Livre' ? 'selected' : ''}}>
                                            Livre</option>
                                        <option value="Reservado" {{old('estado') == 'Reservado' ? 'selected' : ''}}>
                                            Resrvado</option>
                                        <option value="Ocupado" {{old('estado') == 'Ocupado' ? 'selected' : ''}}>
                                            Ocupado</option>
                                        <option value="Manutencao" {{old('estado') == 'Manutencao' ? 'selected' : ''}}>Manutenção
                                        </option>
                                    </select>
                                    </div>
                                    @error('estado')
                                    <small style="color: red">{{$message}}</small>

                                    @enderror

                                </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href=" {{ url('/admin/espacos')}}" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left"></i> Regressar</a>
                            <button class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
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