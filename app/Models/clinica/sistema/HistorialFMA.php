<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class HistorialFMA extends Model
{
    protected $table = 'historial_fma';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'codigo','correlativo','edad','peso','talla','pulso',
        'temperatura','p_a','respiracion','so_dos','ficha_medica_a_id'
    ];

    public function parametro()
    {
        return $this->hasOne(ParametroFMA::class, 'historial_fma_id', 'id');
    }

    public function anexos_fma()
    {
        return $this->hasMany(AnexoFMA::class, 'historial_fma_id', 'id');
    }
}
