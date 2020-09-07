<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;

class Examen extends Model
{
    protected $table = 'examen';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre','laboratio_id','categoria_examen_id'
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
