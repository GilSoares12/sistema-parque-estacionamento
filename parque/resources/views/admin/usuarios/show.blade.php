@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Dados do Usuário</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/usuarios')}}">Lista de usuários</a></li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<hr>

@stop

@section('content')
<div class="row">
    <div class="col-md-10">
        <div class="card card-info shadow-none">
            <div class="card-header">
                <h3 class="card-title"><b><i class="fas fa-user"> </i> Informações Pessoais</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3">
                        <b><i class="fas fa-user"></i> Nome Completo</b>
                        <p> {{$usuario->name}} </p>
                    </div>
                    <div class="col-md-3">
                        <b><i class="fas fa-envelope"></i> Correio Eletrónico</b>
                        <p> {{$usuario->email}} </p>
                    </div>
                    <div class="col-md-3">
                        <b><i class="fas fa-id-card"></i> Documento</b>
                        <p> {{$usuario->tipo_documento." - ".$usuario->numero_documento}} </p>
                    </div>
                    <div class="col-md-3">
                        <b><i class="fas fa-mobile-alt"></i> Contacto</b>
                        <p> {{$usuario->celular}} </p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <b><i class="fas fa-bithday-cake"></i> Data de Nascimento</b>
                        <p> {{$usuario->data_nascimento}} </p>
                    </div>
                    <div class="col-md-3">
                        <b><i class="fas fa-venus-mars"></i> Gênero</b>
                        <p> {{$usuario->genero}} </p>
                    </div>
                    <div class="col-md-6">
                        <b><i class="fas fa-map-marker-alt"></i> Direção</b>
                        <p> {{$usuario->direcao}} </p>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <div class="card card-info shadow-none">
            <div class="card-header">
                <h3 class="card-title"><b><i class="fas fa-user"> </i> Contactos de Ermegência</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <b><i class="fas fa-user"></i> Nome Completo</b>
                        <p> {{$usuario->contacto_nome}} </p>
                    </div>
                    <div class="col-md-4">
                        <b><i class="fas fa-envelope"></i> Contacto</b>
                        <p> {{$usuario->contacto_telefone}} </p>
                    </div>
                    <div class="col-md-4">
                        <b><i class="fas fa-id-card"></i> Documento</b>
                        <p> {{$usuario->contacto_parentesco}} </p>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <div class="col-md-2">
        <div class="card card-outline card-info shadow-none">
            <div class="card-header">
                <h3 class="card-title"><b><i class="fas fa-user"> </i> Perfil</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row text-center">
                    <div class="col-md-12">
                        @if($usuario->foto)
                        <img src="{{ asset('storage/'.$usuario->foto)}}" class="profile-user-img img-fluid img-circle"
                            alt="foto do usuário">
                        @else
                        <img src="{{url('/imagens/avatar.jpg') }}" class="profile-user-img img-fluid img-circle"
                            alt="foto do usuário">
                        @endif

                        <h3 class="profile-username">{{$usuario->name}}</h3>
                        <button class="btn btn-warning">{{$usuario->roles->pluck('name')->implode(', ')}}</button>
                        <br>


                        @if($usuario->estado == 1)
                        <span class="badge badge-success">Activo</span>

                        @else
                        <span class="badge badge-danger">Inactivo</span>

                        @endif

                        <hr>
                        <small><b>Hora e data de Criação:</b> <br>{{$usuario->created_at}}</small>
                    </div>

                </div>
            </div>
            <!-- /.card-body -->
        </div>
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