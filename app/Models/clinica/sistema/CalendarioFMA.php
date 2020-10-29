<?php

namespace App\Models\clinica\sistema;

use App\Models\clinica\catalogo\TipoCita;
use Illuminate\Database\Eloquent\Model;

class CalendarioFMA extends Model
{
    protected $table = 'calendario_fma';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'cita','fecha','hora','ficha_medica_a_id','estado_calendario_id','tipo_cita_id'
    ];

    public function ficha_medica_a()
    {
        return $this->belongsTo(FichaMedicaA::class, 'ficha_medica_a_id', 'id');
    }

    public function estado_calendario()
    {
        return $this->belongsTo(EstadoCalendario::class, 'estado_calendario_id', 'id');
    }

    public function tipo_cita()
    {
        return $this->belongsTo(TipoCita::class, 'tipo_cita_id', 'id');
    }
}
