<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class Inmuncion extends Model
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'inmuncion_historial.restante' => 15,
            'vacuna.nombre' => 10,
            'historial_fmn.codigo' => 5,
        ],
        'joins' => [
            'vacuna' => ['inmuncion_historial.vacuna_id', 'vacuna.id'],
            'historial_fmn' => ['inmuncion_historial.historial_fmn_id', 'historial_fmn.id']
        ]
    ];
    
    protected $table = 'inmuncion_historial';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'restante','historial_fmn_id','vacuna_id'
    ];

    public function vacuna()
    {
        return $this->belongsTo(Vacuna::class, 'vacuna_id', 'id');
    }
}
