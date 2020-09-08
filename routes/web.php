<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Auth::routes();
Route::get('/', 'HomeController@index')->name('home');

Route::resource('alimentacion', 'clinica\catalogo\AlimentacionController');
Route::resource('categoria_examen','clinica\catalogo\CategoriaExamenController');
Route::resource('configuracion_enfermedad', 'clinica\catalogo\ConfiguracionEnfermedadController');
Route::resource('departamento','clinica\catalogo\DepartamentoController');
Route::resource('examen','clinica\catalogo\ExamenController');
Route::resource('laboratorio','clinica\catalogo\LaboratorioController');
Route::resource('municipio','clinica\catalogo\MunicipioController');
Route::resource('parto','clinica\catalogo\PartoController');
Route::resource('tipo_sangre','clinica\catalogo\TipoSangreController');
Route::resource('vacuna','clinica\catalogo\VacunaController');

?>
