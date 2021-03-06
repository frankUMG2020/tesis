<?php

namespace App\Models\clinica\catalogo;

use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    protected $table = 'municipio';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'nombre','departamento_id'
    ];

    public function nombreCompleto()
    {
        $departamento = Departamento::find($this->departamento_id);
        return "{$departamento->nombre}, {$this->nombre}";
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'id')->orderby('nombre');
    }
}
