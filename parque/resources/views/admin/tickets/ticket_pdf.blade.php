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
        <h3 style="margin:5px 0; font-size:14px;text-align: center;"> TICKET {{$ticket->codigo_ticket}}</h3>
        <div class="line"></div>
        <div style="text-align:left;">
             <strong>Dados do Cliente:</strong><br>
            <b>Senhor(a):</b> {{$ticket->cliente->nomes}} <br>  
            <b>Documento:</b>     {{$ticket->cliente->numero_documento}} <br>
            <b>Matricula do Veículo:</b>     {{$ticket->veiculo->placa}}                
        </div>
        <div class="line">
            <div>
                <b> Epaço Nro: </b> {{ $ticket->espaco->numero}} <br>
                <b> Data de Entrada: </b> {{ $ticket->data_entrada}} <br>
                <b> Hora de Entrada: </b> {{ $ticket->hora_entrada}} <br>
            </div>
            <div class="line"></div>
            <div class="footer" style="text-align:center">
                <small style="fonte-size: 5pt">      
                    <b>!Obrigado pela sua preferência!</b> <br>              
                    <b>Hora de Impressão:</b> {{$ficha_hora}} <br>
                    <b>Usuário: </b> {{$ticket->usuario->name}} <br>
                    
                </small>
            </div>
        </div>
    </div>
        
</body>

</html>  
