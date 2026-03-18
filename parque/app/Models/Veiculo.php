<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Veiculo extends Model
{
    protected $table = 'veiculos';

    protected $fillable = [
        'cliente_id',
        'placa',
        'marca',
        'modelo',
        'cor',
        'tipo',        
    ];
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
