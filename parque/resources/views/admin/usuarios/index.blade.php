@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Lista de Usuários</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item active">Usuários</li>
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
                <h3 class="card-title"><b>Usuários registrados</b></h3>

                <!-- /.card-tools -->
                <div class="card-tools">
                    <a href="{{url('/admin/usuarios/create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Criar
                        novo</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="table1" class="table table-bordered table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10px"> Nro </th>
                                        <th>Rol de usuários</th>
                                        <th>Nomes</th>
                                        <th>Apelidos</th>
                                        <th>Tipo de Documentos</th>
                                        <th>Número de Documento</th>
                                        <th>Contacto</th>
                                        <th>Estado</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $usuarios as $usuario)
                                    <tr>
                                        <td style="text-align:center">{{ $loop ->iteration }}</td>                                        
                                        <td>{{ $usuario->roles->pluck('name')->implode(', ')}}</td>
                                        <td>{{ $usuario->nomes}}</td>
                                        <td>{{ $usuario->apelidos}}</td>
                                        <td>{{ $usuario->tipo_documento}}</td>
                                        <td>{{ $usuario->numero_documento}}</td>
                                        <td>{{ $usuario->celular}}</td>
                                        <td style="text-align:center">
                                            @if($usuario->estado == 1)
                                            <span class="badge badge-success">Activo</span>

                                            @else
                                            <span class="badge badge-danger">Inactivo</span>

                                            @endif
                                        </td>
                                        <td class="d-flex justify-content-center">
                                            @if(!($usuario -> deleted_at))
                                            <a href="{{ url('admin/usuario/'.$usuario->id)}}" class="btn btn-info btn-sm"><i class="fas fa-eye">
                                                    Ver</i></a>
                                            <a href="{{url('admin/usuario/'.$usuario->id.'/edit')}}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit">
                                                    Editar</i></a>
                                            <form action="{{url('admin/usuario/'.$usuario->id)}}" method="POST"
                                                id="meuformulario{{$usuario->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="perguntar{{$usuario->id}}(event)"><i class="fas fa-trash-alt">
                                                        Eliminar</i></button>
                                            </form>
                                             <script>
                                            function perguntar{{$usuario->id}}(event){
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: 'Deseja eliminar esse registro?',
                                                    text: '',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Eliminar',
                                                    confirmButtonColor: '#a5161d',
                                                    denyButtonColor: '#250a0a',
                                                    denyButtonText: 'Cancelar'                                                    
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                       //JavaScrip para enviar ao formulário
                                                       document.getElementById('meuformulario{{ $usuario->id}}').submit();
                                                    }
                                                });
                                            }
                                            </script>
                                            @else
                                                <form action="{{url('admin/usuario/'.$usuario->id.'/restaurar')}}" method="POST"
                                                id="meuformulario{{$usuario->id}}">
                                                @csrf
                                                <button class="btn btn-warning btn-sm"
                                                    onclick="perguntar{{$usuario->id}}(event)"><i class="fas fa-save">
                                                        Restaurar usuário</i></button>
                                            </form>
                                             <script>
                                            function perguntar{{$usuario->id}}(event){
                                                event.preventDefault();
                                                Swal.fire({
                                                    title: 'Deseja restaurar esse usuário?',
                                                    text: '',
                                                    icon: 'question',
                                                    showDenyButton: true,
                                                    confirmButtonText: 'Restaurar',
                                                    confirmButtonColor: '#a5161d',
                                                    denyButtonColor: '#250a0a',
                                                    denyButtonText: 'Cancelar'                                                    
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                       //JavaScrip para enviar ao formulário
                                                       document.getElementById('meuformulario{{ $usuario->id}}').submit();
                                                    }
                                                });
                                            }
                                            </script>
                                            @endif
                                           
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
@stop

@section('css')
<style>
/* Fondo transparente y sin borde en el contenedor */
#table1_wrapper .dt-buttons {
    background-color: transparent;
    box-shadow: none;
    border: none;
    display: flex;
    justify-content: center;
    /* Centrar los botones */
    gap: 10px;
    /* Espaciado entre botones */
    margin-bottom: 15px;
    /* Separar botones de la tabla */
}

/* Estilo personalizado para los botones */
#table1_wrapper .btn {
    color: #fff;
    /* Color del texto en blanco */
    border-radius: 4px;
    /* Bordes redondeados */
    padding: 5px 15px;
    /* Espaciado interno */
    font-size: 14px;
    /* Tamaño de fuente */
}

/* Colores por tipo de botón */
.btn-danger {
    background-color: #dc3545;
    border: none;
}

.btn-success {
    background-color: #28a745;
    border: none;
}

.btn-info {
    background-color: #17a2b8;
    border: none;
}

.btn-warning {
    background-color: #ffc107;
    color: #212529;
    border: none;
}

.btn-default {
    background-color: #6e7176;
    color: #212529;
    border: none;
}
</style>
@stop

@section('js')
<script>
$(function() {
    $("#table1").DataTable({
        "pageLength": 10,
        "language": {
            "emptyTable": "Não há informação",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Usuarios",
            "infoEmpty": "Mostrando 0 a 0 de 0 Usuarios",
            "infoFiltered": "(Filtrado de _MAX_ total Usuarios)",
            "lengthMenu": "Mostrar MENU Usuarios",
            "loadingRecords": "Carregando...",
            "processing": "Processando...",
            "search": "Pesquisar:",
            "zeroRecords": "Sem resultados encontrados",
            "paginate": {
                "first": "Primero",
                "last": "Último",
                "next": "Seguinte",
                "previous": "Anterior"
            }
        },
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        buttons: [{
                text: '<i class="fas fa-copy"></i> COPIAR',
                extend: 'copy',
                className: 'btn btn-default'
            },
            {
                text: '<i class="fas fa-file-pdf"></i> PDF',
                extend: 'pdf',
                className: 'btn btn-danger'
            },
            {
                text: '<i class="fas fa-file-csv"></i> CSV',
                extend: 'csv',
                className: 'btn btn-info'
            },
            {
                text: '<i class="fas fa-file-excel"></i> EXCEL',
                extend: 'excel',
                className: 'btn btn-success'
            },
            {
                text: '<i class="fas fa-print"></i> IMPRIMIR',
                extend: 'print',
                className: 'btn btn-warning'
            }
        ]
    }).buttons().container().appendTo('#table1_wrapper .row:eq(0)');
});
</script>
@stop