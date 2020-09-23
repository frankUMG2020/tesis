<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class TipoCita extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'tipo_cita.nombre' => 15,
        ]
    ];
    protected $table = 'tipo_cita';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre','color'
    ];
}
