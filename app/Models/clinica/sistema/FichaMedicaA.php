<?php

namespace App\Models\clinica\sistema;

use App\Models\clinica\catalogo\TipoSangre;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class FichaMedicaA extends Model
{
    use SearchableTrait;

    const SOLTERO = 'SOLTERO';
    const CASADO = 'CASADO';

    protected $searchable = [
        'columns' => [
            'departamento.codigo_epps' => 15,
            'departamento.cui' => 10,
        ]
    ];

    protected $table = 'ficha_medica_a';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'fecha', 'estado_civil', 'profesion', 'foto',
        'remitido', 'observacion', 'codigo_epps', 'cui',
        'tipo_sangre_id', 'persona_id'
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    public function tipo_sangre()
    {
        return $this->belongsTo(TipoSangre::class, 'tipo_sangre_id', 'id');
    }

    public function telefonos()
    {
        return $this->hasMany(TelefonoFMA::class, 'ficha_medica_a_id', 'id');
    }

    public function direcciones()
    {
        return $this->hasMany(DireccionFMA::class, 'ficha_medica_a_id', 'id');
    }

    public function historial_fma()
    {
        return $this->hasMany(HistorialFMA::class, 'ficha_medica_a_id', 'id');
    }
}
