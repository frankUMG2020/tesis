<?php

namespace App\Models\clinica\sistema;

use Illuminate\Support\Facades\DB;
use App\Models\clinica\catalogo\Parto;
use App\Models\clinica\sistema\Persona;
use Illuminate\Database\Eloquent\Model;
use App\Models\clinica\catalogo\Municipio;
use App\Models\clinica\sistema\TelefonoFMN;
use App\Models\clinica\sistema\DireccionFMA;
use App\Models\clinica\sistema\HistorialFMN;
use App\Models\clinica\catalogo\Alimentacion;
use App\Models\clinica\sistema\CalendarioFMA;
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

    public function fechaFormato()
    {
        return date('d-m-Y', strtotime($this->fecha));
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'id');
    }

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
            OR CONCAT(nombre_uno,' ',nombre_dos,' ',apellido_uno,' ',apellido_dos) LIKE '%$nombres%')"));
        }
    }
    
    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'id');
    }

    public function parto()
    {
        return $this->belongsTo(Parto::class, 'parto_id', 'id');
    }

    public function alimentacion()
    {
        return $this->belongsTo(Alimentacion::class, 'alimentacion_id', 'id');
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
