<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
     protected $table = 'tickets';

    protected $fillable = [
        'espaco_id',
        'cliente_id',
        'veiculo_id',
        'tarifa_id',
        'usuario_id',
        'codigo_ticket',
        'data_entrada',
        'hora_entrada',
        'data_saida',
        'tempo_total',
        'valor_total',
        'estado',
        'obs',        
    ];

    public function espaco(){
        return $this->belongsTo(Espaco::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function veiculo(){
        return $this->belongsTo(Veiculo::class);
    }
    public function tarifa(){
        return $this->belongsTo(Tarifa::class);
    }
    public function usuario(){
        return $this->belongsTo(User::class);
    }
     public function faturacao(){
        return $this->hasOne(Faturacao::class);
    }
}
