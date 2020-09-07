<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;

class CategoriaExamen extends Model
{
    protected $table = 'categoria_examen';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre'
    ];
}
