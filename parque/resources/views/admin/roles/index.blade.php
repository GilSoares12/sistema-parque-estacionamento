@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Lista de Roles</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item active">Roles</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<hr>

@stop

@section('content')
<div class="row">
    <div class="col-md-6">
        <div class="card card-outline card-primary ">
            <div class="card-header">
                <h3 class="card-title"><b>Roles registrados</b></h3>

                <!-- /.card-tools -->
                <div class="card-tools">
                    <a href="{{url('/admin/roles/create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Criar
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
                                        <th>Nome do Rol</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $roles as $role)
                                    <tr>
                                        <td style="text-align:center">{{ $loop ->iteration }}</td>
                                        <td>{{ $role->name}}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{url('admin/rol/' .$role->id. '/permissoes')}}" class="btn btn-warning btn-sm"><i class="fas fa-check">
                                                    Adicionar permissões</i></a>

                                            <a href="{{url('admin/rol/'.$role->id . '/edit')}}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit">
                                                    Editar</i></a>
                                            <form action="{{url('admin/rol/'.$role->id)}}" method="POST"
                                                id="meuformulario{{$role->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="perguntar{{$role->id}}(event)"><i class="fas fa-trash-alt">
                                                        Eliminar</i></button>
                                            </form>
                                            <script>
                                            function perguntar{{$role->id}}(event){
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
                                                       document.getElementById('meuformulario{{ $role->id}}').submit();
                                                    }
                                                });
                                            }
                                            </script>
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
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Roles",
            "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
            "infoFiltered": "(Filtrado de _MAX_ total Roles)",
            "lengthMenu": "Mostrar MENU Roles",
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