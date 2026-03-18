@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0">Lista de Tarifas</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
                <li class="breadcrumb-item active">Tarifas</li>
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
                <h3 class="card-title"><b>Tarifas registradas por hora</b></h3>

                <!-- /.card-tools -->
                <div class="card-tools">
                    <a href="{{url('/admin/tarifas/create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Criar
                        nova</a>
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
                                        <th>Nome</th>
                                        <th>Quantidade</th>
                                        <th>Tipo</th>
                                        <th>Custo</th>                                        
                                        <th>Minutos de Graça</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                     @php 
                                        $conta = 1;
                                    @endphp

                                    @foreach( $tarifas as $tarifa)
                                   @if($tarifa->tipo == 'por_hora')
                                    <tr>
                                        <td style="text-align:center">{{ $conta++ }}</td>
                                        <td>{{$tarifa->nome}}</td>
                                        <td style="text-align:center;">{{$tarifa->quantidade}}</td>
                                         <td>{{$tarifa->tipo}}</td>
                                        <td>{{$ajuste->divisa." ".$tarifa->custo}}</td>                                       
                                        <td style="text-align:center">{{$tarifa->minutos_de_graca}} min</td>
                                        <td class="d-flex justify-content-center">
                                           
                                            <a href="{{url('admin/tarifa/'.$tarifa->id.'/edit')}}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit">
                                                    Editar</i></a>
                                            <form action="{{url('admin/tarifa/'.$tarifa->id)}}" method="POST"
                                                id="meuformulario{{$tarifa->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="perguntar{{$tarifa->id}}(event)"><i class="fas fa-trash-alt">
                                                        Eliminar</i></button>
                                            </form>
                                            <script>
                                            function perguntar{{$tarifa->id}}(event){
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
                                                       document.getElementById('meuformulario{{ $tarifa->id}}').submit();
                                                    }
                                                });
                                            }
                                            </script>
                                        </td>
                                    </tr>

                                   @endif
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
    <div class="col-md-6">
        <div class="card card-outline card-primary ">
            <div class="card-header">
                <h3 class="card-title"><b>Tarifas registradas por dia</b></h3>

                <!-- /.card-tools -->
                <div class="card-tools">
                    <a href="{{url('/admin/tarifas/create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> Criar
                        nova</a>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="table2" class="table table-bordered table-striped table-hover table-sm">
                                <thead>
                                    <tr>
                                        <th style="width: 10px"> Nro </th>
                                        <th>Nome</th>
                                        <th>Quantidade</th>
                                        <th>Tipo</th>
                                        <th>Custo</th>                                        
                                        <th>Minutos de Graça</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php 
                                        $contador = 1;
                                    @endphp

                                    @foreach( $tarifas as $tarifa)
                                   @if($tarifa->tipo == 'por_dia')
                                    <tr>
                                        <td style="text-align:center">{{ $contador++ }}</td>
                                        <td>{{$tarifa->nome}}</td>
                                        <td style="text-align:center;">{{$tarifa->quantidade}}</td>
                                         <td>{{$tarifa->tipo}}</td>
                                        <td>{{$ajuste->divisa." ".$tarifa->custo}}</td>                                       
                                        <td style="text-align:center">{{$tarifa->minutos_de_graca}} min</td>
                                        <td class="d-flex justify-content-center">
                                           
                                            <a href="{{url('admin/tarifa/'.$tarifa->id.'/edit')}}"
                                                class="btn btn-success btn-sm"><i class="fas fa-edit">
                                                    Editar</i></a>
                                            <form action="{{url('admin/tarifa/'.$tarifa->id)}}" method="POST"
                                                id="meuformulario{{$tarifa->id}}">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm"
                                                    onclick="perguntar{{$tarifa->id}}(event)"><i class="fas fa-trash-alt">
                                                        Eliminar</i></button>
                                            </form>
                                            <script>
                                            function perguntar{{$tarifa->id}}(event){
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
                                                       document.getElementById('meuformulario{{ $tarifa->id}}').submit();
                                                    }
                                                });
                                            }
                                            </script>
                                        </td>
                                    </tr>

                                   @endif
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

#table2_wrapper .dt-buttons {
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
#table2_wrapper .btn {
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
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Tariifas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
            "infoFiltered": "(Filtrado de _MAX_ total Tarifas)",
            "lengthMenu": "Mostrar MENU Tarifas",
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


 $("#table2").DataTable({
        "pageLength": 10,
        "language": {
            "emptyTable": "Não há informação",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Tariifas",
            "infoEmpty": "Mostrando 0 a 0 de 0 Roles",
            "infoFiltered": "(Filtrado de _MAX_ total Tarifas)",
            "lengthMenu": "Mostrar MENU Tarifas",
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
    }).buttons().container().appendTo('#table2_wrapper .row:eq(0)');
});
</script>
@stop