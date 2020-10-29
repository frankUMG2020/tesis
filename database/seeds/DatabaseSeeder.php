<?php

use Illuminate\Database\Seeder;
use App\Imports\MunicipioImport;
use App\Imports\DepartamentoImport;
use App\Models\clinica\catalogo\Alimentacion;
use App\Models\clinica\catalogo\CategoriaExamen;
use App\Models\clinica\catalogo\ConfiguracionEnfermedad;
use App\Models\clinica\catalogo\Examen;
use App\Models\clinica\catalogo\Laboratorio;
use App\Models\clinica\catalogo\Parto;
use App\Models\clinica\catalogo\TipoCita;
use App\Models\clinica\catalogo\TipoSangre;
use App\Models\clinica\catalogo\Vacuna;
use App\Models\clinica\seguridad\Rol;
use App\Models\clinica\seguridad\Usuario;
use App\Models\clinica\sistema\EstadoCalendario;
use App\Models\clinica\sistema\Persona;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \Excel::import(new DepartamentoImport, 'database/excel/Departamentos.xlsx');
        \Excel::import(new MunicipioImport, 'database/excel/Municipios.xlsx');

        $alimentacion = new Alimentacion();
        $alimentacion->nombre = 'Leche';
        $alimentacion->save();

        $alimentacion = new Alimentacion();
        $alimentacion->nombre = 'Frijol';
        $alimentacion->save();

        $alimentacion = new Alimentacion();
        $alimentacion->nombre = 'Arroz';
        $alimentacion->save();

        $alimentacion = new Alimentacion();
        $alimentacion->nombre = 'Incaparina';
        $alimentacion->save();

        $categoria_examen = new CategoriaExamen();
        $categoria_examen->nombre = 'Categoria 1';
        $categoria_examen->save();

        $categoria_examen = new CategoriaExamen();
        $categoria_examen->nombre = 'Categoria 2';
        $categoria_examen->save();

        $configuracion_enfermedad = new ConfiguracionEnfermedad();
        $configuracion_enfermedad->nombre = 'Enfermedad 1';
        $configuracion_enfermedad->save();

        $configuracion_enfermedad = new ConfiguracionEnfermedad();
        $configuracion_enfermedad->nombre = 'Enfermedad 2';
        $configuracion_enfermedad->save();

        $laboratorio = new Laboratorio();
        $laboratorio->nombre = 'Laboratorio 1';
        $laboratorio->save();

        $laboratorio = new Laboratorio();
        $laboratorio->nombre = 'Laboratorio 2';
        $laboratorio->save();

        $categorias_examenes = CategoriaExamen::all();

        foreach ($categorias_examenes as $value) {
            
            $laboratorios = Laboratorio::all();

            foreach ($laboratorios as $lab) {
                
                for ($i=0; $i < 50; $i++) { 
                    $examen = new Examen();
                    $examen->nombre = "Examen {$value->id}.{$lab->id}.{$i}";
                    $examen->laboratorio_id = $lab->id;
                    $examen->categoria_examen_id = $value->id;
                    $examen->save();
                }

            }
        }

        $insert = new EstadoCalendario();
        $insert->nombre = 'Activo';
        $insert->save();

        $insert = new EstadoCalendario();
        $insert->nombre = 'Suspendido';
        $insert->save();

        $insert = new EstadoCalendario();
        $insert->nombre = 'Asistio';
        $insert->save();

        $parto = new Parto();
        $parto->nombre = 'Normal';
        $parto->save();

        $parto = new Parto();
        $parto->nombre = 'Cesarea';
        $parto->save();

        $tipo_cita = new TipoCita();
        $tipo_cita->nombre = 'Normal';
        $tipo_cita->color = '#62bfa8';
        $tipo_cita->save();

        $tipo_cita = new TipoCita();
        $tipo_cita->nombre = 'Emergencia';
        $tipo_cita->color = '#dc3545';
        $tipo_cita->save();

        $tipo_cita = new TipoCita();
        $tipo_cita->nombre = 'EPPS';
        $tipo_cita->color = '#ffc107';
        $tipo_cita->save();

        $tipo_sangre = new TipoSangre();
        $tipo_sangre->nombre = 'O+';
        $tipo_sangre->save();

        $tipo_sangre = new TipoSangre();
        $tipo_sangre->nombre = 'O-';
        $tipo_sangre->save();

        for ($i=0; $i < 12; $i++) { 
            $vacuna = new Vacuna();
            $vacuna->nombre = "Vacuna {$i}";
            $vacuna->dosis = random_int(1,10);
            $vacuna->save();
        }

        $insert = new Rol();
        $insert->nombre = 'Administrador';
        $insert->save();

        $insert = new Rol();
        $insert->nombre = 'Secretaría';
        $insert->save();

        $insert = new Rol();
        $insert->nombre = 'Médico';
        $insert->save();

        $persona = new Persona();
        $persona->nombre_uno = 'Administrador';
        $persona->nombre_dos = null;
        $persona->apellido_uno = ' ';
        $persona->apellido_dos = null;
        $persona->sexo = Persona::Masculino;
        $persona->fecha_nacimiento = '1993-12-18';
        $persona->save();

        $usuario = new Usuario();
        $usuario->nombre_completo = "{$persona->nombre_uno} {$persona->apellido_uno}";
        $usuario->email = "administrador@umg.com";
        $usuario->password = "secret";
        $usuario->activo = true;
        $usuario->persona_id = $persona->id;
        $usuario->rol_id = Rol::find(1)->id;
        $usuario->save();

    }
}
