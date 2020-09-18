<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class Inmuncion extends Model
{
    protected $table = 'inmuncion_historial';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'restante','historial_fmn_id','vacuna_id'
    ];

    public function vacuna()
    {
        return $this->belongsTo(Vacuna::class, 'vacuna_id', 'id');
    }
}
