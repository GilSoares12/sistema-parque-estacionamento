<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Espaco extends Model
{
      protected $table = 'espacos';

    protected $fillable = [
        'numero',
        'estao',               
    ];
    public function tickets(){
        return $this->hasMany(Ticket::class);
    }
}
