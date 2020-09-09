<?php

use App\Imports\CarreraImport;
use Illuminate\Database\Seeder;
use App\Imports\MunicipioImport;
use App\Imports\DepartamentoImport;
use App\Models\escuela\seguridad\Rol;
use App\Models\escuela\sistema\Persona;
use App\Models\escuela\catalogo\Carrera;
use App\Models\escuela\catalogo\Seccion;
use App\Models\escuela\catalogo\Bimestre;
use App\Models\escuela\catalogo\Curso;
use App\Models\escuela\seguridad\Usuario;

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

        
    }
}
