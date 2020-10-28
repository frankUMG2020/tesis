<?php

namespace App\Models\clinica\seguridad;

use App\Models\clinica\sistema\Persona;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    use SearchableTrait;

    protected $searchable = [
        'columns' => [
            'usuario.nombre_completo' => 10,
            'usuario.email' => 15,
        ]
    ];
    
    protected $table = 'usuario';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre_completo','email','password','activo','persona_id','rol_id'
    ];

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    public function rol()
    {
        return $this->belongsTo(Rol::class, 'rol_id', 'id');
    }
}
