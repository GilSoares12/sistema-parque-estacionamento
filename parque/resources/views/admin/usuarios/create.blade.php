@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Registro de um novo usuário</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/usuarios')}}">Lista de usuarios</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<hr>

@stop

@section('content')
<form action="{{url('admin/usuarios/create')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary ">
                <div class="card-header">
                    <h3 class="card-title"><b>Preencher os campos do formulário</b></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="">Roles</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-check"></i>
                                        </span>
                                    </div>
                                    <select name="rol" class="form-control" id="">
                                        <option value="">Selecione um rol</option>
                                        @foreach($roles as $role)
                                        @if(!($role->name == 'SUPER ADMIN'))
                                        <option value="{{ $role->name}}"
                                            {{old('rol') == $role->name ? 'selected' : ''}}> {{$role->name}} </option>
                                        @endif

                                        @endforeach
                                    </select>
                                </div>
                                @error('rol')
                                <small style="color: red">{{$message}}</small>

                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nomes">Nome do Usuário</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="nomes" value="{{ old('nomes')}}"
                                        placeholder=" Nomes" required>
                                </div>
                                @error('nomes')
                                <small style="color: red">{{$message}}</small>

                                @enderror

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="apelidos">Apelidos</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="apelidos" value="{{ old('apelidos')}}"
                                        placeholder=" Nomes" required>
                                </div>
                                @error('apelidos')
                                <small style="color: red">{{$message}}</small>

                                @enderror

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="email">Correio Eletrónico</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" name="email" value="{{ old('email')}}"
                                        placeholder=" Correio Eletrónico" required>
                                </div>
                                @error('email')
                                <small style="color: red">{{$message}}</small>

                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tipo_documento">Tipo de Documento</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                    <select name="tipo_documento" class="form-control" id="tipo_documento">
                                        <option value="">Selecione...</option>
                                        <option value="BI" {{old('tipo_documento') == 'BI' ? 'selected' : ''}}>Bilhete
                                            de Identidade</option>
                                        <option value="Passaporte"
                                            {{old('tipo_documento') == 'Passaporte' ? 'selected' : ''}}>Passaporte
                                        </option>
                                    </select>
                                </div>
                                @error('tipo_documento')
                                <small style="color: red">{{$message}}</small>

                                @enderror

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="numero_documento">Número do Documento</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-id-card"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="numero_documento"
                                        value="{{ old('numero_documento')}}" placeholder=" Número do Documento"
                                        required>
                                </div>
                                @error('numero_documento')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="celular">Contacto</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-mobile-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="celular" value="{{ old('celular')}}"
                                        placeholder=" Contacto" required>
                                </div>
                                @error('celular')
                                <small style="color: red">{{$message}}</small>

                                @enderror

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="data_nascimento">Data de Nascimento</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="date" class="form-control" name="data_nascimento"
                                        value="{{ old('data_nascimento')}}" required>
                                </div>
                                @error('data_nascimento')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
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
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="direcao">Direção</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="direcao" value="{{ old('direcao')}}"
                                        required>
                                </div>
                                @error('direcao')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card card-info shadow-none">
                <div class="card-header">
                    <h3 class="card-title"><b>Contactos de Emergências</b></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contacto_nome">Nome do Contacto de Ermegência</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-shield"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="contacto_nome"
                                        value="{{ old('contacto_nome')}}" placeholder=" Nome do Contacto" required>
                                </div>
                                @error('contacto_nome')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contacto_telefone">Número do Contacto de Ermegência</label> <b> (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-phone"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="contacto_telefone"
                                        value="{{ old('contacto_telefone')}}" placeholder=" Número do Contacto"
                                        required>
                                </div>
                                @error('contacto_telefone')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="contacto_parentesco">Parentesco do Contacto de Ermegência</label> <b>
                                    (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-user-friends"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="contacto_parentesco"
                                        value="{{ old('contacto_parentesco')}}" placeholder=" Parentesco do Contacto"
                                        required>
                                </div>
                                @error('contacto_parentesco')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-md-12">
            <a href=" {{ url('/admin/usuarios')}}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                Regressar</a>
            <button class="btn btn-primary"><i class="fas fa-save"></i> Guardar</button>
        </div>
    </div>
</form>
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