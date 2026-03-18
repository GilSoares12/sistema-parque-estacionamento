@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"><b>Cliente:</b> {{$cliente->nomes}} </h1>
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
        <div class="card card-info ">
            <div class="card-header">
                <h3 class="card-title"><b>Dados registrados do cliente</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="nomes"><i class="fas fa-user"></i> Nome Completo</label>
                            <p> {{ $cliente->nomes }} </p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="numero_documento"><i class="fas fa-id-card"></i> Número do Documento</label>
                            <p>{{ $cliente->numero_documento }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="email"> <i class="fas fa-envelope"></i> Correio Electrónico</label>
                            <p>{{ $cliente->email }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="contacto"><i class="fas fa-mobile-alt"></i> Contacto</label>
                            <p>{{ $cliente->contacto }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="tipo_cliente"><i class="fas fa-venus-mars"></i> Tipo</label>
                            <p>{{ $cliente->tipo_cliente }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="genero"><i class="fas fa-venus-mars"></i> Gênero</label>
                            <p>{{ $cliente->genero }}</p>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="genero"> Estado</label><br>
                            @if($cliente->estado == 1)
                            <span class="badge badge-success">Activo</span>

                            @else
                            <span class="badge badge-danger">Inactivo</span>

                            @endif
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
        <div class="card card-outline card-info ">
            <div class="card-header">
                <h3 class="card-title"><b>Lista de Veículos</b></h3>
                <!-- /.card-tools -->
                <div class="card-tools">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#ModalCreateVeiculo">
                        <i class="fas fa-plus"></i> Criar
                        novo</a>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="ModalCreateVeiculo" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #2945c4; color:white">
                                    <h5 class="modal-title" id="exampleModalLabel">Registro de Veículo</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{url('/admin/clientes/veiculos/create')}}" method="post">
                                        @csrf
                                        <input type="hidden" value=" {{$cliente->id}}" name="cliente_id">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="placa">Placa do Veículo</label> <b> (*)</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-car"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" name="placa"
                                                            value="{{ old('placa')}}" placeholder=" Lx-xx-xx-xx"
                                                            style="text-transform: uppercase" required>
                                                    </div>
                                                    @error('placa')
                                                    <small style="color: red">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="marca">Marca</label> <b> (*)</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-industry"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" name="marca"
                                                            value="{{ old('marca')}}" placeholder=" Toyota, Honda, etc."
                                                            required>
                                                    </div>
                                                    @error('marca')
                                                    <small style="color: red">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="modelo">Modelo</label> <b> (*)</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-car-side"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" name="modelo"
                                                            value="{{ old('modelo')}}" placeholder=" Corola, Sedã, etc."
                                                            required>
                                                    </div>
                                                    @error('modelo')
                                                    <small style="color: red">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="cor">Cor</label> <b> (*)</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-palette"></i>
                                                            </span>
                                                        </div>
                                                        <input type="text" class="form-control" name="cor"
                                                            value="{{ old('cor')}}" placeholder=" Azul, Branco, etc."
                                                            required>
                                                    </div>
                                                    @error('cor')
                                                    <small style="color: red">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="tipo">Tipo de Veículo</label> <b> (*)</b>
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-truck"></i>
                                                            </span>
                                                        </div>
                                                        <select name="tipo" class="form-control" id="tipo">
                                                            <option value="auto"
                                                                {{old('tipo') == 'auto' ? 'selected' : ''}}>
                                                                Automóvel</option>
                                                            <option value="motocicleta"
                                                                {{old('tipo') == 'motocicleta' ? 'selected' : ''}}>
                                                                Motocicleta</option>
                                                            <option value="camiao"
                                                                {{old('tipo') == 'camiao' ? 'selected' : ''}}>Camião
                                                            </option>
                                                        </select>
                                                    </div>
                                                    @error('tipo')
                                                    <small style="color: red">{{$message}}</small>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <hr>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Registrar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="table-responsive">
                    <table id="table1" class="table table-bordered table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th style="width: 10px"> Nro </th>
                                <th>Placa</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Cor</th>
                                <th>Tipo</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $cliente->veiculos as $veiculo)
                            <tr>
                                <td style="text-align:center">{{ $loop ->iteration }}</td>
                                <td>{{ $veiculo->placa}}</td>
                                <td>{{ $veiculo->marca}}</td>
                                <td>{{ $veiculo->modelo}}</td>
                                <td>{{ $veiculo->cor}}</td>
                                <td>{{ $veiculo->tipo}}</td>
                                <td class="d-flex justify-content-center">
                                   
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal"
                                        data-target="#ModalEditVeiculo{{$veiculo->id}}">
                                        <i class="fas fa-edit">
                                            Editar</i></a>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="ModalEditVeiculo{{$veiculo->id}}" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header"
                                                    style="background-color: #1f9c44; color:white">
                                                    <h5 class="modal-title" id="exampleModalLabel">Editar dados do Veículo
                                                    </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{url('/admin/clientes/veiculo/'.$veiculo->id)}}"
                                                        method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" value=" {{$cliente->id}}"
                                                            name="cliente_id">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="placa">Placa do Veículo</label> <b>
                                                                        (*)</b>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-car"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="placa" value="{{ old('placa',$veiculo->placa)}}"
                                                                            placeholder=" Lx-xx-xx-xx"
                                                                            style="text-transform: uppercase" required>
                                                                    </div>
                                                                    @error('placa')
                                                                    <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="marca">Marca</label> <b> (*)</b>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-industry"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="marca" value="{{ old('marca',$veiculo->marca)}}"
                                                                            placeholder=" Toyota, Honda, etc." required>
                                                                    </div>
                                                                    @error('marca')
                                                                    <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="modelo">Modelo</label> <b> (*)</b>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-car-side"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="modelo" value="{{ old('modelo',$veiculo->modelo)}}"
                                                                            placeholder=" Corola, Sedã, etc." required>
                                                                    </div>
                                                                    @error('modelo')
                                                                    <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label for="cor">Cor</label> <b> (*)</b>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-palette"></i>
                                                                            </span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            name="cor" value="{{ old('cor',$veiculo->cor)}}"
                                                                            placeholder=" Azul, Branco, etc." required>
                                                                    </div>
                                                                    @error('cor')
                                                                    <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label for="tipo">Tipo de Veículo</label> <b>
                                                                        (*)</b>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">
                                                                                <i class="fas fa-truck"></i>
                                                                            </span>
                                                                        </div>
                                                                        <select name="tipo" class="form-control"
                                                                            id="tipo">
                                                                            <option value="auto"
                                                                                {{old('tipo',$veiculo->tipo) == 'auto' ? 'selected' : ''}}>
                                                                                Automóvel</option>
                                                                            <option value="motocicleta"
                                                                                {{old('tipo',$veiculo->tipo) == 'motocicleta' ? 'selected' : ''}}>
                                                                                Motocicleta</option>
                                                                            <option value="camiao"
                                                                                {{old('tipo',$veiculo->tipo) == 'camiao' ? 'selected' : ''}}>
                                                                                Camião
                                                                            </option>
                                                                        </select>
                                                                    </div>
                                                                    @error('tipo')
                                                                    <small style="color: red">{{$message}}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr>

                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-dismiss="modal">Cancelar</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Registrar</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->

                                    <form action="{{url('admin/clientes/veiculo/'.$veiculo->id)}}" method="POST"
                                        id="meuformulario{{$veiculo->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="perguntar{{$veiculo->id}}(event)"><i class="fas fa-trash-alt">
                                                Eliminar</i></button>
                                    </form>
                                    <script>
                                    function perguntar{{$veiculo->id}}(event) {
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
                                                document.getElementById('meuformulario{{ $veiculo->id}}')
                                                    .submit();
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
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Veiculos",
            "infoEmpty": "Mostrando 0 a 0 de 0 Veiculos",
            "infoFiltered": "(Filtrado de _MAX_ total Veiculos)",
            "lengthMenu": "Mostrar MENU Veiculos",
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