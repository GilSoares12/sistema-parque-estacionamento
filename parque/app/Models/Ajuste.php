<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ajuste extends Model
{
    protected $table = 'ajustes';

    protected $fillable = [
        'nome',
        'descricao',
        'filial',
        'direcao',
        'telefone',
        'logo',
        'logo_auto',
        'divisa',
        'correio',
        'pagina_web',
    ];
}
