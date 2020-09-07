<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class TelefonoFMN extends Model
{
    protected $table = 'telefono_fmn';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'numero','ficha_medica_n_id'
    ];
}
