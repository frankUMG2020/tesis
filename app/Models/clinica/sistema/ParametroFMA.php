<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class ParametroFMA extends Model
{
    protected $table = 'parametro_fma';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'parametro_uno','parametro_dos','parametro_tres','parametro_cuatro',
        'parametro_seis','parametro_siete','parametro_ocho','parametro_nueve',
        'parametro_diez','parametro_once','parametro_doce','parametro_trece',
        'historial_fma_id'
    ];
}
