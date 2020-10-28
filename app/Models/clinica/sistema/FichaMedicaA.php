<?php

namespace App\Models\clinica\sistema;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\clinica\catalogo\TipoSangre;

class FichaMedicaA extends Model
{
    const Soltero = 'Soltero';
    const Casado = 'Casado';
    const Viudo = 'Viudo';
    const Divorciado = 'Divorciado';

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

    public function scopeBuscar($query, $nombres)
    {
        if ($nombres) {
            return $query->where('persona_id', DB::RAW("(SELECT id FROM persona 
            WHERE nombre_uno LIKE '%$nombres%'
            OR nombre_dos LIKE '%$nombres%'
            OR apellido_uno LIKE '%$nombres%'
            OR apellido_dos LIKE '%$nombres%'
            OR CONCAT(nombre_uno,' ',nombre_dos) LIKE '%$nombres%'
            OR CONCAT(apellido_uno,' ',apellido_dos) LIKE '%$nombres%'
            OR CONCAT(nombre_uno,' ',apellido_uno) LIKE '%$nombres%'
            OR CONCAT(nombre_uno,' ',nombre_dos,' ',apellido_uno,' ',apellido_dos) LIKE '%$nombres%'
            ORDER BY id DESC
            LIMIT 1)"));
        }
    }

    public function fechaFormato()
    {
        return date('d-m-Y', strtotime($this->fecha));
    }

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

    public function historiales_fma()
    {
        return $this->hasMany(HistorialFMA::class, 'ficha_medica_a_id', 'id');
    }

    public function calendarios_fma()
    {
        return $this->hasMany(CalendarioFMA::class, 'ficha_medica_a_id', 'id');
    }
}
