<div class="row">

    <div class="col-md-6">
        <p><b>Informação do Cliente</b></p>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nomes"><i class="fas fa-user"></i> Nome Completo</label>
                    <p> {{ $veiculo->cliente->nomes }} </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="numero_documento"><i class="fas fa-id-card"></i> Número do Documento</label>
                    <p>{{ $veiculo->cliente->numero_documento }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email"> <i class="fas fa-envelope"></i> Correio Electrónico</label>
                    <p>{{ $veiculo->cliente->email }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="contacto"><i class="fas fa-mobile-alt"></i> Contacto</label>
                    <p>{{ $veiculo->cliente->contacto }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tipo_cliente"><i class="fas fa-venus-mars"></i> Tipo</label>
                    <p>{{ $veiculo->cliente->tipo_cliente }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <p><b>Informação do Veículo</b></p>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="placa">Placa do Veículo</label>
                    <p>{{ $veiculo->placa }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="marca">Marca</label> <b> (*)</b>
                    <p>{{ $veiculo->marca }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="modelo">Modelo</label> <b> (*)</b>
                    <p>{{ $veiculo->modelo }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cor">Cor</label> <b> (*)</b>
                    <p>{{ $veiculo->cor }}</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tipo">Tipo de Veículo</label> <b> (*)</b>
                    <p>{{ $veiculo->tipo }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
