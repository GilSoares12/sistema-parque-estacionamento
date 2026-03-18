<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;
      protected $table = 'clientes';

    protected $fillable = [
        'nome',
        'numero_documento',
        'email',
        'contacto',
        'tipo_cliente',
        'genero',
        'estado',
        
    ];
    public function veiculos(){
        return $this->hasMany(Veiculo::class);
    }
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
