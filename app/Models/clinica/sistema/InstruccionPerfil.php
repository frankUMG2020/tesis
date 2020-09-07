<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class InstruccionPerfil extends Model
{
    protected $table = 'instruccion_perfil';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'descripcion'
    ];
}
