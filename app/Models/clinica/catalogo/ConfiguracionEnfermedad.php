<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;

class ConfiguracionEnfermedad extends Model
{
    protected $table = 'configuracion_enfermedad';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre'
    ];
}
