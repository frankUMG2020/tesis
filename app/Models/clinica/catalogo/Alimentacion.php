<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
class Alimentacion extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'alimentacion.nombre' => 15,
        ]
    ];

    protected $table = 'alimentacion';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre'
    ];
}
