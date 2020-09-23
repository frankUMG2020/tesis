<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class ConfiguracionEnfermedad extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'configuracion_enfermedad.nombre' => 15,
        ]
    ];

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
