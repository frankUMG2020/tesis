<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Rutas que tiene información precargada para utilizar en tablas principales
Route::resource('alimentacion', 'clinica\catalogo\AlimentacionController');
Route::resource('categoriaExamen','clinica\catalogo\CategoriaExamenController');
Route::resource('configuracionEnfermedad', 'clinica\catalogo\ConfiguracionEnfermedadController');
Route::resource('departamento','clinica\catalogo\DepartamentoController');
Route::resource('examen','clinica\catalogo\ExamenController');
Route::resource('laboratorio','clinica\catalogo\LaboratorioController');
Route::resource('municipio','clinica\catalogo\MunicipioController');
Route::resource('parto','clinica\catalogo\PartoController');
Route::resource('tipoCita', 'clinica\catalogo\TipoCitaController');
Route::resource('tipoSangre','clinica\catalogo\TipoSangreController');
Route::resource('vacuna','clinica\catalogo\VacunaController');
Route::resource('perfil', 'clinica\sistema\PerfilController');
Route::resource('perfilExamen', 'clinica\sistema\PerfilExamenController');
Route::resource('inmuncion', 'clinica\sistema\InmuncionController');
Route::resource('instruccionPerfil', 'clinica\sistema\InstruccionPerfilController');
Route::resource('estadoCalendario', 'clinica\sistema\EstadoCalendarioController');

//Rutas que tiene información para usuarios y roles
Route::resource('rol', 'clinica\seguridad\RolController');
Route::resource('usuario', 'clinica\seguridad\UsuarioController');

//Rutas que tienen información de tablas principales
Route::resource('anexoFMA', 'clinica\sistema\AnexoFMAController');
Route::resource('anexoFMN', 'clinica\sistema\AnexoFMNController');
Route::resource('calendarioFMA', 'clinica\sistema\CalendarioFMAController');
Route::resource('calendarioFMN', 'clinica\sistema\CalendarioFMNController');
Route::resource('direccionFMA', 'clinica\sistema\DireccionFMAController');
Route::resource('direccionFMN', 'clinica\sistema\DireccionFMNController');
Route::resource('enfermedadHistorial', 'clinica\sistema\EnfermedadHistorialController');
Route::resource('eTFMA', 'clinica\sistema\ETFMAController');
Route::resource('eTFMN', 'clinica\sistema\ETFMNController');
Route::resource('examenFMA', 'clinica\sistema\ExamenFMAController');
Route::resource('examenFMN', 'clinica\sistema\ExamenFMNController');
Route::resource('fichaMedicaA', 'clinica\sistema\FichaMedicaAController');
Route::resource('fichaMedicaN', 'clinica\sistema\FichaMedicaNController');
Route::resource('historialFMA', 'clinica\sistema\HistorialFMAController');
Route::resource('historialFMN', 'clinica\sistema\HistorialFMNController');
Route::resource('parametroFMA', 'clinica\sistema\ParametroFMAController');
Route::resource('parametroFMN', 'clinica\sistema\ParametroFMNController');
Route::resource('persona', 'clinica\sistema\PersonaController');
Route::resource('telefonoFMA', 'clinica\sistema\TelefonoFMAController');
Route::resource('telefonoFMN', 'clinica\sistema\TelefonoFMNController');
?>
