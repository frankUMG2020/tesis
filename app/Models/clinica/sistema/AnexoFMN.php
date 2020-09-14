<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class AnexoFMN extends Model
{
    protected $table = 'anexo_fmn';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre','path','historial_fmn_id'
    ];
}
