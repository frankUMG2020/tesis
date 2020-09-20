<?php

namespace App\Models\clinica\sistema;

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
}
