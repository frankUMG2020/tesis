<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class TipoSangre extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'tipo_sangre.nombre' => 15,
        ]
    ];
    protected $table = 'tipo_sangre';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre'
    ];
}
