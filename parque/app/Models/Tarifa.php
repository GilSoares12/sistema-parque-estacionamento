<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
     protected $table = 'tarifas';

    protected $fillable = [
        'nome',
        'tipo',
        'custo',
        'quantidade',
        'minutos_de_graca',
        
    ];
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
