<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Perfil extends Model
{
    use SearchableTrait;
    
    protected $searchable = [
        'columns' => [
            'perfil.nombre' => 15
        ],
        'joins' => [
            'instruccion_perfil' => ['perfil.instruccion_perfil_id', 'instruccion_perfil.id']
        ]
    ];
    protected $table = 'perfil';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre','instruccion_perfil_id'
    ];

    public function instruccion_perfil()
    {
        return $this->belongsTo(InstruccionPerfil::class, 'instruccion_perfil_id', 'id');
    }

    public function perfil_examenes()
    {
        return $this->hasMany(PerfilExamen::class, 'perfil_id', 'id');
    }
}
