<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class PerfilExamen extends Model
{
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
}
