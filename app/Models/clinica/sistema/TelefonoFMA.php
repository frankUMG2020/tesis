<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class TelefonoFMA extends Model
{
    protected $table = 'telefono_fma';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'numero','ficha_medica_a_id'
    ];
}
