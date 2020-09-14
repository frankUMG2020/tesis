<?php

namespace App\Models\clinica\sistema;

use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;

class FichaMedicaN extends Model
{
    use SearchableTrait;

    protected $serchable= [
        'columns' => [
            
        ]
    ];
    protected $table = 'ficha_medica_n';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'fecha','padre','madre','referido','email',
        'lugar_nacimiento','foto','municipio_id',
        'persona_id','parto_id','alimentacion_id'
    ];

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }
    
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    public function parto()
    {
        return $this->belongsTo(Parto::class, 'parto_id', 'id');
    }

    public function telefonos()
    {
        return $this->hasMany(TelefonoFMN::class, 'ficha_medica_n_id', 'id');
    }

    public function direcciones()
    {
        return $this->hasMany(DireccionFMA::class, 'ficha_medica_n_id', 'id');
    }
    
    public function historiales_fmn()
    {
        return $this->hasMany(HistorialFMN::class, 'ficha_medica_n_id', 'id');
    }

    public function calendarios_fma()
    {
        return $this->hasMany(CalendarioFMA::class, 'ficha_medica_N_id', 'id');
    }
}
