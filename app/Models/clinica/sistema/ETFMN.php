<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class ETFMN extends Model
{
    protected $table = 'e_t_fmn';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'evolucion','tratamiento','parametros_fmn_id'
    ];

    public function parametrofma()
    {
        return $this->belongsTo(ParametroFMN::class, 'parametros_fmn_id', 'id');
    }
}
