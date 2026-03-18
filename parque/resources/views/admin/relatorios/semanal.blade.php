<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório Semanal</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0;
        }
        .container{
            padding: 20px 40px;
        }
        .header{
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1{
            color: #333;
            font-size: 24px;
            margin: 0;
            padding: 0;
        }
        .header p {
            color: #777;
            margin: 5px 0 0;
        }
        .report-info{
            background-color: #f4f4f4;
            padding: 10px;
            border-left: 4px solid #17a2b8;
            margin-bottom: 20px;
        }
        .report-info strong{
            color: #555;
        }
        table{
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td{
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
        }
        .total-row{
            font-weight: bold;
            background-color: #e9ecef;
        }
        .footer{
            text-align: center;
            margin-top: 40px;
            font-size: 10px;
            color: #aaa;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Relatório de Facturação Semanal</h1>
            <p>Gerado em: {{now()->format('d/m/Y')." ".now()->format('H:i:s A') }}</p>
        </div>
        <div class="report-info">
            <p><b>Periodo do Relatorio:</b> {{ \Carbon\Carbon::parse($data_inicio)->format('d/m/Y')." até ".\Carbon\Carbon::parse($data_final)->format('d/m/Y') }}</p>
        </div>
        @if($facturacoes->isEmpty())
            <p style="text-align:center;">Não há facturações no periodo selecionado.</p>
        @else
        <table>
            <thead>
                <tr>
                    <th>Nro</th>
                    <th>Cliente</th>
                    <th>Veículo</th>
                    <th style="width: 170px;">Detalhe</th>
                    <th>Valor</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @php 
                    $total_valor = 0;
                @endphp
                    @foreach($facturacoes as $factura)
                    <tr>
                        <td>{{$loop->iteration}}</td>
                        <td>{{$factura->nome_cliente}}</td>
                        <td>{{$factura->placa}}</td>
                        <td>{{$factura->detalhe}}</td>
                        <td>{{$ajuste->divisa." ".$factura->valor_total}}</td>
                        <td>{{\Carbon\Carbon::parse($factura->created_at)->format('d/m/Y')}}</td>
                    </tr>
                    @php 
                        $total_valor += $factura->valor_total;
                    @endphp
                    @endforeach  
                    <tr class="total-row">
                        <td colspan="4" style="text-align:right;">Total</td>
                        <td colspan="2" >{{$ajuste->divisa." ".$total_valor}}</td>
                    </tr>

            </tbody>
        </table>
        @endif
        <div class="footer">
            <p>Relatório gerado pelo {{$ajuste->nome}} - Copyright &copy; {{date('Y')}} - Impresso por: {{$usuario->name}}</p>
        </div>
    </div>
</body>
</html>