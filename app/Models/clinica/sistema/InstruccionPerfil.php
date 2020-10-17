<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class InstruccionPerfil extends Model
{
    use SearchableTrait;
    
    protected $searchable = [
        'columns' => [
            'instruccion_perfil.descripcion' => 15
        ]
    ];
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
