<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;

class AnexoFMA extends Model
{
    protected $table = 'anexo_fma';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre','path','historial_fma_id'
    ];
}
