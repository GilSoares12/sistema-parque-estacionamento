<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Faturacao extends Model
{
    protected $table = 'faturacaos';

    protected $fillable = [
        'ticket_id',
        'usuario_id',
        'nro_factura',
        'nome_cliente',
        'nro_documento',
        'placa',
        'detalhe',
        'valor_total',
        
    ];

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }
     public function usuario(){
        return $this->belongsTo(User::class);
    }
}
