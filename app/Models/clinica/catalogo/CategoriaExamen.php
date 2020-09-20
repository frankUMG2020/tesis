<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class CategoriaExamen extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'categoria_examen.nombre' => 15,
        ]
    ];
    
    protected $table = 'categoria_examen';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre'
    ];

    public function examenes()
    {
        return $this->hasMany(Examen::class, 'categoria_examen_id', 'id')->orderBy('nombre');
    }
}
