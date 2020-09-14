<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class HistorialFMN extends Model
{
    protected $table = 'historial_fmn';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'codigo','correlativo','edad','peso','descripcion',
        'ficha_medica_n_id'
    ];

    public function inmuciones()
    {
        return $this->hasMany(Inmuncion::class, 'historial_fmn_id', 'id');
    }

    public function enfermedades()
    {
        return $this->hasMany(EnfermedadHistorial::class, 'historial_fmn_id', 'id');
    }

    public function parametros()
    {
        return $this->hasMany(ParametroFMN::class, 'historial_fmn_id', 'id');
    }

    public function anexos_fmn()
    {
        return $this->hasMany(AnexoFMN::class, 'historial_fmn_id', 'id');
    }
}
