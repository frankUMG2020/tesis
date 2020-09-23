<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Parto extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'parto.nombre' => 15,
        ]
    ];
    protected $table = 'parto';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre'
    ];
}
