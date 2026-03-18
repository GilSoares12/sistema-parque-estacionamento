@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Lista de Veículos</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item active">Lista de Veículos</li>
            </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
</div><!-- /.container-fluid -->

<hr>

@stop

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card card-outline card-primary ">
            <div class="card-header">
                <h3 class="card-title"><b>Veículos registrados</b></h3>

                <!-- /.card-tools -->
                
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
                                        <th>Cliente</th>
                                         <th>Tipo</th>
                                        <th>Placa</th>
                                        <th>Marca</th>
                                        <th>Modelo</th>
                                        <th>Cor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach( $veiculos as $veiculo)
                                    <tr>
                                        <td style="text-align:center">{{ $loop ->iteration }}</td>
                                        <td>{{ $veiculo->cliente->names}}</td>
                                        <td>{{ $veiculo->tipo}}</td>
                                        <td>{{ $veiculo->placa}}</td>
                                        <td>{{ $veiculo->marca}}</td>
                                        <td>{{ $veiculo->modelo}}</td>
                                        <td>{{ $veiculo->cor}}</td>                                        
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
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Veículos",
            "infoEmpty": "Mostrando 0 a 0 de 0 Veículos",
            "infoFiltered": "(Filtrado de _MAX_ total Veículos)",
            "lengthMenu": "Mostrar MENU Veículos",
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