@extends('adminlte::page')


@section('content_header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1 class="m-0"> Rastreamento do Estacionamento</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{url('/admin')}}">Inicio</a></li>
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
                <h3 class="card-title"><b>Espaços registrados</b></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row">
                    @foreach($espacos as $espaco)
                    @php
                    $ticket_ativo = $tickets_ativos->firstWhere('espaco_id',$espaco->id)

                    @endphp
                    <div class="col-md-1 col-4" style="text-align:center">
                        <h5>ESP-{{$espaco->numero}}</h5>

                        @if ($ticket_ativo)
                        <button class="btn btn-danger btn-ocupado" data-ticket-id="{{$ticket_ativo->id}}"
                            data-codigo="{{$ticket_ativo->codigo_ticket}}"
                            data-cliente="{{$ticket_ativo->cliente->nomes}}"
                            data-documento="{{$ticket_ativo->cliente->numero_documento}}"
                            data-placa="{{$ticket_ativo->veiculo->placa}}"
                            data-numero_espaco="{{$ticket_ativo->espaco->numero}}"
                            data-data_entrada="{{$ticket_ativo->data_entrada}}"
                            data-hora_entrada="{{$ticket_ativo->hora_entrada}}"
                            data-tarifa_nome="{{$ticket_ativo->tarifa->nome}}"
                            data-tarifa_tipo="{{$ticket_ativo->tarifa->tipo}}" style="width: 100%; height: 200px">
                            <div style="display:flex; justify-content:center; align-items:center;">
                                <img src="{{ asset('storage/logos/'.$ajuste->logo_auto)}}" alt=""
                                    style="max-width:100px; margin-top:10px; ">
                            </div>
                            <small>{{$ticket_ativo->veiculo->placa}}</small> <br>
                            <small>{{$ticket_ativo->data_entrada}}</small> <br>
                            <small>{{$ticket_ativo->hora_entrada}}</small>
                        </button>
                        @else
                        @if($espaco->estado == "Livre")
                        <button class="btn btn-success btn-ticket" data-espaco-id="{{$espaco->id}}"
                            data-numero-espaco="{{$espaco->numero}}" style="width: 100%; height: 200px">
                            LIVRE
                        </button>
                        @endif

                        @if($espaco->estado == "Reservado")
                        <button class="btn btn-primary btn-reservado" style="width: 100%; height: 200px">
                            Reservado
                        </button>
                        @endif

                        @if($espaco->estado == "Manutencao")
                        <button class="btn btn-warning btn-manutencao" style="width: 100%; height: 200px">
                            Manutenção
                        </button>
                        @endif
                        @if($espaco->estado == "Ocupado")
                        <button class="btn btn-danger " style="width: 100%; height: 200px">
                            OCUPADO
                        </button>
                        @endif
                        @endif


                        <!-- Button trigger modal -->

                        <!-- Modal -->
                        <br><br>
                    </div>
                    @endforeach
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<!-- Modal para ticket -->
<div class="modal fade" id="modal_ticket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #0921a8; color:white;">
                <h5 class="modal-title" id="exampleModalLabel">Gerar Ticket do espaço <span id="espaco"></span> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{url('/admin/tickets/create')}}" method="POST" id="form_ticket">
                    @csrf
                    <input type="hidden" id="espaco_id" name="espaco_id">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="placa">Placa do Veículo</label> <b>
                                    (*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-car"></i>
                                        </span>
                                    </div>
                                    <select name="veiculo_id" id="veiculo_id" class="form-control select2">
                                        <option value="">Buscar Veículo...</option>
                                        @foreach($veiculos as $veiculo)
                                        <option value="{{ $veiculo->id}}"> Placa: {{ $veiculo->placa}} - Cliente:
                                            {{$veiculo->cliente->nomes}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('placa')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div style="height:32px"></div>
                                <a href="{{url('/admin/clientes/create')}}" class="btn btn-primary"> Novo cliente </a>
                            </div>
                        </div>
                    </div>

                    <div id="info_veiculo">

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="tarifa">Tarifas</label> <b>(*)</b>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-car"></i>
                                        </span>
                                    </div>
                                    <select name="tarifa_id" id="tarifa_id" class="form-control select2">
                                        @foreach($tarifas as $tarifa)
                                        <option value="{{ $tarifa->id}}"> Tarifa: {{ $tarifa->nome}} - Tipo:
                                            {{ $tarifa->tipo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('tarifa')
                                <small style="color: red">{{$message}}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="obs">Observação</label>
                            <textarea name="obs" id="obs" class="form-control" cols="30" rows="2"></textarea>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<!-- Modal para Manutenção -->
<div class="modal fade" id="modal_manutencao" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dda01c; color:white;">
                <h5 class="modal-title" id="exampleModalLabel">Estado do Estacionamento </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p style="text-align: center;"><b>O estado deste espaço está em manutenção.</b></p>
            </div>

        </div>
    </div>
</div>

<!-- Modal para Reservado -->


<!-- Modal para ocupado -->
<div class="modal fade" id="modal_ocupado" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dd1c1c; color:white;">
                <h5 class="modal-title" id="exampleModalLabel">Finalizar Ticket </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <h1 style="margin:5px 0;text-align: center;">
                            <b>TICKET: </b> <span id="codigo_ticket"></span>
                        </h1>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <b>Dados do Cliente:</b> <br>
                        <b>Senhor(a):</b> <span id="cliente"></span> <br>
                        <b>Documento:</b> <span id="documento"></span> <br>
                        <b>Matricula do Veículo:</b> <span id="placa"></span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <b> Epaço Nro: </b> <span id="numero_espaco"></span> <br>
                        <b> Data de Entrada: </b> <span id="data_entrada"></span> <br>
                        <b> Hora de Entrada: </b> <span id="hora_entrada"></span>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <b> Dados da Tarifa: </b> <br>
                        <b> Nome: </b> <span id="tarifa_nome"></span> <br>
                        <b> Tipo: </b> <span id="tarifa_tipo"></span>
                    </div>
                </div>

                <hr>
                <form action="{{url('admin/ticket/atualizar_tarifa')}}" method="POST">
                    @csrf
                    <input type="hidden" id="ticket_id_editar_tarifa" name="ticket_id_editar_tarifa">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="tarifa">Modificar Tarifa:</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="fas fa-car"></i>
                                        </span>
                                    </div>
                                    <select name="tarifa_id" id="tarifa_id" class="form-control " required>
                                        <option value="">Selecione uma Tarifa...</option>
                                        @foreach($tarifas as $tarifa)
                                        <option value="{{ $tarifa->id}}"> Tarifa: {{ $tarifa->nome}} - Tipo:
                                            {{ $tarifa->tipo}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div style="height: 32px"></div>
                                <button type="submit" class="btn btn-success">Atualizar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <div class="row">
                    <div class="col-md-12" >
                        <b> Tempo Decorrido: </b> <br>
                        <span id="tempo_decorrido"></span>
                    </div>
                </div>

                <hr>
                <div class="row">
                    <h2 style="font-size: 20pt; color: #0921a8">
                        <div class="col-md-12">
                        <b> Valor Total a Pagar: <span id="custo_total_a_pagar"></span>
                        <i class="fas fa-money-bill-wave"></i>
                    </b> 
                        
                    </div>
                    </h2>
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button class="btn btn-secondary" data-dismiss="modal">Fechar</button>

                    <form action="" method="POST" id="form_cancel_ticket" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="ticket_id" id="ticket_id">
                        <button class="btn btn-danger" id="btn_cancelar_ticket"><i class="fas fa-trash-alt">
                                Cancelar Ticket</i></button>
                    </form>


                    <a href="#" id="btn_imprimir_ticket" data-dismiss="modal" data-toggle="modal"
                        data-target="#modal_pdf_ticket" class="btn btn-warning"><i class="fas fa-print"></i>
                        Imprimir</a>

                    <a href="#" id="btn_facturar" class="btn btn-success"><i class="fas fa-money-bill"></i>
                        Facturar</a>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
</div>

<!-- Modal para Vista de Impressão de ticket -->
<div class="modal fade" id="modal_pdf_ticket" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dda01c; color:white;">
                <h5 class="modal-title" id="exampleModalLabel">Impressão de Ticket </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="pdf_iframe_ticket" style="width: 100%; height: 50vh;" frameborder="0"></iframe>
            </div>

        </div>
    </div>
</div>

<!-- Modal para Vista de Impressão da Factura -->
<div class="modal fade" id="modal_pdf_factura" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #dda01c; color:white;">
                <h5 class="modal-title" id="exampleModalLabel">Impressão da Factura </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="pdf_iframe_factura" style="width: 100%; height: 50vh;" frameborder="0"></iframe>
            </div>

        </div>
    </div>
</div>

@stop

@section('css')
<style>
.select2-container .select2-selection--single {
    height: 35px !important;
}
</style>
@stop

@section('js')

<script>
let ticket_a_imprimir = null;
$(document).ready(function() {
    $('.select2').select2({
        allowClear: true,
        width: '90%',
        dropdownParent: $('#modal_ticket')
    });
    $('#veiculo_id').on('change', function() {
        var veiculo_id = $(this).val();
        if (veiculo_id) {
            $.ajax({
                url: " {{url('admin/tickets/veiculo')}}/" + veiculo_id,
                type: 'GET',
                success: function(data) {
                    $('#info_veiculo').html(data);
                },
                error: function() {
                    $('#info_veiculo').html('<p>Erro ao carregar a informação</p>');
                }
            });
        } else {
            alert("Deves selecionar um veiculo");
        }
    });
});

$('#form_ticket').on('submit', function(event) {
    var espaco_id = $('#espaco_id').val();
    var veiculo_id = $('#veiculo_id').val();
    var tarifa_id = $('#tarifa_id').val();
    //lert(espaco_id + "-" + veiculo_id + "-" + tarifa_id);

    if (!espaco_id || !veiculo_id || !tarifa_id) {
        event.preventDefault();
        alert("Por favor, preenche todos os campos");
    }
});

$('.btn-ticket').on('click', function() {
    var espaco_id = $(this).data('espaco-id');
    var numero_espaco = $(this).data('numero-espaco');
    $('#espaco_id').val(espaco_id);
    $('#espaco').html(numero_espaco);
    $('#modal_ticket').modal('show');
});



$('.btn-manutencao').on('click', function() {
    $('#modal_manutencao').modal('show');
});

$('.btn-ocupado').on('click', function() {
    var ticket_id = $(this).data('ticket-id');
    var codigo = $(this).data('codigo');
    var cliente = $(this).data('cliente');
    var documento = $(this).data('documento');
    var placa = $(this).data('placa');
    var numero_espaco = $(this).data('numero_espaco');
    var data_entrada = $(this).data('data_entrada');
    var hora_entrada = $(this).data('hora_entrada');
    var tarifa_nome = $(this).data('tarifa_nome');
    var tarifa_tipo = $(this).data('tarifa_tipo');

    ticket_a_imprimir = $(this).data('ticket-id');

    $('#ticket_id').val(ticket_id);
    $('#ticket_id_editar_tarifa').val(ticket_id);
    $('#codigo_ticket').html(codigo);
    $('#cliente').html(cliente);
    $('#documento').html(documento);
    $('#placa').html(placa);
    $('#numero_espaco').html(numero_espaco);
    $('#data_entrada').html(data_entrada);
    $('#hora_entrada').html(hora_entrada);
    $('#tarifa_nome').html(tarifa_nome);
    $('#tarifa_tipo').html(tarifa_tipo);

    //$('#btn_imprimir_ticket').attr('href', urlImprimir);
    var url_finalizar_ticket = "{{url('admin/ticket/')}}" + "/" + ticket_id + "/finalizar_ticket";
    $('#btn_facturar').attr('href', url_finalizar_ticket);

    //calculo de tempo para cancelar ticket
    const dataHoraIngresso = new Date(data_entrada + " " + hora_entrada);
    const agora = new Date();
    const differencaMinutos = Math.floor((agora - dataHoraIngresso) / 60000);
    const dias = Math.floor(differencaMinutos / (60 * 24));
    const horasRestantes = differencaMinutos % (60 * 24);
    const horas = Math.floor(horasRestantes / 60);
    const minutos = horasRestantes % 60;

    const tempoDecorrido = dias + " dias com " + horas + " horas e " + minutos + " minutos";
    $('#tempo_decorrido').html(tempoDecorrido);

    const modal = $('#modal_ocupado');
    const botaoCancelar = modal.find('#btn_cancelar_ticket');
    const botaoFacturar = modal.find('#btn_facturar');
    const custoTotal = modal.find('#custo_total_a_pagar');

    if (differencaMinutos > 10) {
        botaoCancelar.prop('disabled', true);
        botaoFacturar.show();
        custoTotal.show();
    } else {
        botaoCancelar.prop('disabled', false);
        botaoFacturar.hide();
        custoTotal.hide();
    }
    $.ajax({
        url : "{{url('admin/ticket/')}}" + "/" + ticket_id + "/calcular_valor",
        type: 'GET',
        success: function(data){
            $('#custo_total_a_pagar').html(data);
        },error: function(){
            $('#custo_total_a_pagar').html('<p> Erro ao carregar a informação</p>');
        }
    })
    
    //alert(differencaMinutos);

    $('#modal_ocupado').modal('show');

});

$('#btn_imprimir_ticket').on('click', function() {
    if (ticket_a_imprimir) {
        var urlImprimir = "{{url('admin/ticket/')}}" + "/" + ticket_a_imprimir + "/imprimir";
        $('#pdf_iframe_ticket').attr('src', urlImprimir);

    }

})
</script>
@if(session('ticket_id'))
<script>
var ticket_id = "{{ session('ticket_id') }}";
var urlImprimir = "{{url('admin/ticket/')}}" + "/" + ticket_id + "/imprimir";
$('#pdf_iframe_ticket').attr('src', urlImprimir);
$('#modal_pdf_ticket').modal('show');
</script>
@endif

</script>
@if(session('factura_id'))
<script>
var factura_id = "{{ session('factura_id') }}";
var urlImprimir = "{{url('admin/factura/')}}" + "/" + factura_id;
$('#pdf_iframe_factura').attr('src', urlImprimir);
$('#modal_pdf_factura').modal('show');
</script>
@endif


<script>
$('#btn_cancelar_ticket').on('click', function() {
    event.preventDefault();
    var ticket_id = $('#ticket_id').val();
    if (ticket_id) {
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
                var form = $('#form_cancel_ticket');
                var url = "{{url('/admin/ticket/')}}" + "/" + ticket_id;
                form.attr('action', url);
                form.submit();
            }
        });
    }

})
</script>
@stop