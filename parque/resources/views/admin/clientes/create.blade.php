@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Registro de um novo cliente</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/clientes')}}">Lista de clientes</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<hr>

@stop

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary ">
            <div class="card-header">
                <h3 class="card-title"><b>Preencher os campos do formulário</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('admin/clientes/create')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nomes">Nome do Completo</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="nomes" value="{{ old('nomes','S/N')}}"
                                        placeholder=" Escreva  aqui..." required>
                                </div>
                                @error('nomes')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="numero_documento">Número do Documento</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="numero_documento"
                                        value="{{ old('numero_documento','S/D')}}" placeholder=" Escreva  aqui..." required>
                                </div>
                                @error('numero_documento')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="mail">Correio Electrónico</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="email" value="{{ old('email','cliente@correio.com')}}"
                                        placeholder=" cliente@correio.com" required>
                                </div>
                                @error('email')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contacto">Contacto</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-mobile-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="contacto" value="{{ old('contacto','S/C')}}"
                                        placeholder=" 9xx-xxx-xxx" required>
                                </div>
                                @error('contacto')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo_cliente">Tipo</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-venus-mars"></i>
                                        </span>
                                    </div>
                                    <select name="tipo_cliente" class="form-control" id="tipo_cliente">
                                        <option value="">Selecione...</option>
                                        <option value="Professor" {{old('tipo_cliente') == 'Professor' ? 'selected' : ''}}>
                                        Professor</option>
                                        <option value="Estudante" {{old('tipo_cliente') == 'Estudante' ? 'selected' : ''}}>
                                        Estudante</option>
                                        <option value="Funcionario" {{old('tipo_cliente') == 'Funcionario' ? 'selected' : ''}}>Funcionario
                                        </option>
                                        <option value="Visitante" {{old('tipo_cliente') == 'Visitante' ? 'selected' : ''}}>Visitante
                                        </option>
                                    </select>
                                </div>
                                @error('tipo_cliente')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="genero">Gênero</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-venus-mars"></i>
                                        </span>
                                    </div>
                                    <select name="genero" class="form-control" id="genero">
                                        <option value="">Selecione...</option>
                                        <option value="Masculino" {{old('genero') == 'Masculino' ? 'selected' : ''}}>
                                            Masculino</option>
                                        <option value="Femenino" {{old('genero') == 'Femenino' ? 'selected' : ''}}>
                                            Femenino</option>
                                        <option value="Outro" {{old('genero') == 'Outro' ? 'selected' : ''}}>Outro
                                        </option>
                                    </select>
                                </div>
                                @error('genero')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <a href=" {{ url('/admin/clientes')}}" class="btn btn-secondary"><i
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