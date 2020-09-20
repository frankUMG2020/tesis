<?php

use Illuminate\Database\Seeder;
use App\Imports\MunicipioImport;
use App\Imports\DepartamentoImport;
use App\Models\clinica\seguridad\Rol;
use App\Models\clinica\seguridad\Usuario;
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
