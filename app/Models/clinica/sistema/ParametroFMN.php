<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class ParametroFMN extends Model
{
    protected $table = 'parametros_fmn';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'parametro_uno','parametro_dos','parametro_tres','parametro_cuatro',
        'parametro_seis','parametro_siete','parametro_ocho','parametro_nueve',
        'parametro_diez','parametro_once','parametro_doce','parametro_trece',
        'historial_fmn_id'
    ];
}
