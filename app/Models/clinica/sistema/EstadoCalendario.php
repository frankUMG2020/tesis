<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class EstadoCalendario extends Model
{
    use SearchableTrait;
    
    protected $searchable = [
        'columns' => [
            'estado_calendario.nombre' => 15
        ]
    ];
    
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
