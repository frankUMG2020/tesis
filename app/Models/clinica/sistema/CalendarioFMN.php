<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class CalendarioFMN extends Model
{
    protected $table = 'calendario_fmn';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'cita','fecha','hora','ficha_medica_n_id','estado_calendario_id','tipo_cita_id'
    ];

    public function estado_calendario()
    {
        return $this->belongsTo(EstadoCalendario::class, 'estado_calendario_id', 'id');
    }

    public function tipo_cita()
    {
        return $this->belongsTo(TipoCita::class, 'tipo_cita_id', 'id');
    }
}
