<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tickey</title>

    <style>
    body {
        font-family: 'Courier New', Courier, monospace;
        font-size: 12px;
        line-height: 1.2;
        width: 300px;
        max-width: 300px;
        overflow-x: hidden;
        margin: 0px;
        padding: 0px;
        background-color: #fff;
    }

    .container {
        border: 0px solid #000;
        margin: 0px;
        padding: 0px;
    }

    .header,
    .footer {
        
    }

    .line {
        border-top: 1px dashed #000;
        margin: 5px 0;
    }
    table{
        width: 100%;
        border-collapse: collapse;
        margin: 5px 0;
    }
    th, td{
        border: 1px solid #000;
        padding: 3px;
        font-size: 10px;
    }
    
    </style>
</head>

<body>
    <div class="container">
        <div class="header"  style="text-align: center;">
            <b >{{$ajuste->nome}}</b> <br>
            {{$ajuste->descricao}} <br>
            Filial: {{$ajuste->filial}} <br>
            {{$ajuste->telefone}} <br>
            {{$ajuste->direcao}} <br>
        </div>
        <div class="line"></div>
        <h3 style="margin:5px 0; font-size:14px;text-align: center;"> FACTURA {{$factura->nro_factura}}</h3>
        <div class="line"></div>
        <div style="text-align:left;">
             <strong>DADOS DO CLIENTE:</strong><br>
            <b>Senhor(a):</b> {{$factura->nome_cliente}} <br>  
            <b>Documento:</b>     {{$factura->nro_documento}} <br>
            <b>Matricula do Veículo:</b>     {{$factura->placa}}                
        </div>
        <div class="line"></div>
            <div>
                <strong>DADOS DO SERVIÇO:</strong><br>
                <b> Epaço Nro: </b> {{ $factura->ticket->espaco->numero}} <br>
                <b> Data de Entrada: </b> {{ $factura->ticket->data_entrada}} <br>
                <b> Hora de Entrada: </b> {{ $factura->ticket->hora_entrada}} <br>
                <b> Data de Saída: </b> {{ $factura->ticket->data_saida}} <br>
                <b> Hora de Saída: </b> {{ $factura->ticket->hora_saida}} <br>
            </div>
            <div class="line"></div>
            <div>
                <strong>DADOS DA TARIFA:</strong><br>
                <b> Nome: </b> {{ $factura->ticket->tarifa->nome}} <br>
                <b> Tipo: </b> {{ $factura->ticket->tarifa->tipo}} <br>
            </div>
            <div class="line"></div>
            <div>
                <table>
                    <thead>
                        <th style="width: 150px">Detalhe</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{$factura->detalhe}}</td>                            
                            <td style="text-align: center;">1</td>
                            <td>{{$ajuste->divisa." ".$factura->valor_total}}</td>
                        </tr>
                    </tbody>
                </table>
                <p style="text-align: right"><b>Valor Total:</b> {{$ajuste->divisa." ".$factura->valor_total}} </p> 
            </div>       
            <div class="line"></div>     
            

            <div class="line"></div>
            <div class="footer" style="text-align:center">
                <small style="fonte-size: 5pt">      
                    <b>!Obrigado pela sua preferência!</b> <br>              
                    <b>Hora de Impressão:</b> {{$ficha_hora}} <br>
                    <b>Usuário: </b> {{$factura->usuario->name}} <br>
                    
                </small>
            </div>
        </div>
    </div>
        
</body>

</html>  
