<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class ExamenFMN extends Model
{
    protected $table = 'examen_fmn';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'historial_fmn_id','examen_id'
    ];

    public function examen()
    {
        return $this->belongsTo(Examen::class, 'examen_id', 'id');
    }
}
