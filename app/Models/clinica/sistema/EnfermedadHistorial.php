<?php

namespace App\Models\clinica\sistema;

use App\Models\clinica\catalogo\ConfiguracionEnfermedad;
use Illuminate\Database\Eloquent\Model;

class EnfermedadHistorial extends Model
{
    protected $table = 'enfermedad_historial';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'cantidad', 'historial_fmn_id','configuracion_enfermedad_id'
    ];

    public function configuracion_enfermedad()
    {
        return $this->belongsTo(ConfiguracionEnfermedad::class, 'configuracion_enferdad_id', 'id');
    }
}
