<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class EstadoCalendario extends Model
{
    protected $table = 'estado_calendario';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre'
    ];
}
