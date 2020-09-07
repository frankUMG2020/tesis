<?php

namespace App\Models\clinica\sistema;

use App\Models\clinica\catalogo\Municipio;
use Illuminate\Database\Eloquent\Model;

class DireccionFMA extends Model
{
    protected $table = 'direccion_fma';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'direccion','ficha_medica_a_id','municipio_id'
    ];
    
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }
}
