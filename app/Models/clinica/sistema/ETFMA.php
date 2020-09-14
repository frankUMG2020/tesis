<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class ETFMA extends Model
{
    protected $table = 'e_t_fma';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'evolucion','tratamiento','parametros_fma_id'
    ];

    public function parametrofma()
    {
        return $this->belongsTo(ParametroFMA::class, 'parametros_fma_id', 'id');
    }
}
