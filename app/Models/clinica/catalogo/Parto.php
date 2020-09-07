<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;

class Parto extends Model
{
    protected $table = 'parto';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre'
    ];
}
