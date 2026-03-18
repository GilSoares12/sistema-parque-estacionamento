@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"><b>Permissões do Rol:</b> {{$role->name}}</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item"><a href="{{url('/admin/roles')}}">Lista de roles</a></li>
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
                <h3 class="card-title"><b>Permissões registrados no sistema</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form action="{{url('admin/rol/' .$role->id. '/update_permissoes')}}" method="POST">
                    @csrf
                    <div class="row">
                        @foreach ($permissoes as $modulo => $grupoPermissoes)
                            <div class="col-md-3">
                                <h4><b>{{$modulo}}</b></h4>
                                @foreach($grupoPermissoes as $permissao)
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" name="permissoes[]"
                                        value="{{$permissao->id}}"
                                        {{$role->hasPermissionTo($permissao->name) ? 'checked' : ''}}>
                                        <label classr="form-check-label">
                                            {{$permissao->name}}
                                        </label>
                                    </div>
                                @endforeach
                                <br>
                            </div>
                        @endforeach
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Adicionar</button>
                            <a href=" {{ url('/admin/roles')}}" class="btn btn-secondary"> Cancelar</a>
                            
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