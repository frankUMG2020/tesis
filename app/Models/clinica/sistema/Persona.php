<?php

namespace App\Models\clinica\sistema;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    const Masculino = 'Masculino';
    const Femenino = 'Femenino';

    protected $table = 'persona';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre_uno','nombre_dos','apellido_uno','apellido_dos','sexo','fecha_nacimiento'
    ];

    public function edadPersona()
    {
        return Carbon::parse($this->fecha_nacimiento)->age;
    }

    public function fechaFormato()
    {
        return date('d-m-Y', strtotime($this->fecha_nacimiento));
    }

    public function nombreCompleto()
    {
        return "{$this->nombre_uno} {$this->nombre_dos} {$this->apellido_uno} {$this->apellido_dos}";
    }
}
