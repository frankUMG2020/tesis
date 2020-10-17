<?php

namespace App\Models\clinica\sistema;

use App\Models\clinica\catalogo\Examen;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class PerfilExamen extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'perfil.nombre' => 10,
            'examen.nombre' => 5,
        ],
        'joins' => [
            'perfil' => ['perfil_examen.perfil_id', 'perfil.id'],
            'examen' => ['perfil_examen.examen_id', 'examen.id']
        ]
    ];
    protected $table = 'perfil_examen';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'perfil_id','examen_id'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examen_id', 'id');
    }

    public function perfil()
    {
        return $this->belongsTo(Perfil::class, 'perfil_id', 'id');
    }
}
