<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class ExamenFMA extends Model
{
    protected $table = 'examen_fma';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'historial_fma_id','examen_id'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examen_id', 'id');
    }
}
