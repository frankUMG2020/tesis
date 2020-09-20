<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Examen extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'examen.nombre' => 15,
            'laboratorio.nombre' => 10,
            'categoria_examen.nombre' => 5,
        ],
        'joins' => [
            'laboratorio' => ['examen.laboratorio_id', 'laboratorio.id'],
            'categoria_examen' => ['examen.categoria_examen_id', 'categoria_examen.id']
        ]
    ];
    
    protected $table = 'examen';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre', 'laboratorio_id','categoria_examen_id'
    ];

    public function laboratorio()
    {
        return $this->belongsTo(Laboratorio::class, 'laboratorio_id', 'id');
    }

    public function categoria_examen()
    {
        return $this->belongsTo(CategoriaExamen::class, 'categoria_examen_id', 'id');
    }
}
