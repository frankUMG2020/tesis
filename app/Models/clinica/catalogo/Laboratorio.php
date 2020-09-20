<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Laboratorio extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'laboratorio.nombre' => 15,
            'laboratorio.direccion' => 20,
            'laboratorio.telefono' => 30,
        ]
    ];

    protected $table = 'laboratorio';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre','direccion','telefono'
    ];
}
