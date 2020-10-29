<?php

use App\Models\clinica\sistema\FichaMedicaA;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
Route::resource('alimentacion', 'clinica\catalogo\AlimentacionController')->except('show');
Route::resource('categoriaExamen','clinica\catalogo\CategoriaExamenController')->except('show');
Route::resource('configuracionEnfermedad', 'clinica\catalogo\ConfiguracionEnfermedadController')->except('show');
Route::resource('examen','clinica\catalogo\ExamenController')->except('show');
Route::resource('laboratorio','clinica\catalogo\LaboratorioController')->except('show');
Route::resource('parto','clinica\catalogo\PartoController')->except('show');
Route::resource('tipoCita', 'clinica\catalogo\TipoCitaController')->except('show');
Route::resource('tipoSangre','clinica\catalogo\TipoSangreController')->except('show');
Route::resource('vacuna','clinica\catalogo\VacunaController')->except('show');
Route::resource('perfil', 'clinica\sistema\PerfilController')->except('show');
Route::resource('perfilExamen', 'clinica\sistema\PerfilExamenController')->except('show');
Route::resource('inmuncion', 'clinica\sistema\InmuncionController')->except('show');
Route::resource('instruccionPerfil', 'clinica\sistema\InstruccionPerfilController')->except('show');
Route::resource('estadoCalendario', 'clinica\sistema\EstadoCalendarioController')->except('show');

//Rutas que tiene información para usuarios y roles
Route::resource('usuario', 'clinica\seguridad\UsuarioController');

//Rutas que tienen información de tablas principales
Route::resource('calendarioFMA', 'clinica\sistema\CalendarioFMAController')->except('show');
Route::resource('direccionFMA', 'clinica\sistema\DireccionFMAController')->except('index','create','update','destroy');
Route::resource('fichaMedicaA', 'clinica\sistema\FichaMedicaAController')->except('show');
Route::resource('historialFMA', 'clinica\sistema\HistorialFMAController')->except('index','create','edit');
Route::name('historialFMA.create_historial')->get('create/historialFMA/{ficha_medica_a_id}', 'clinica\sistema\historialFMAController@create_historial');
Route::resource('telefonoFMA', 'clinica\sistema\TelefonoFMAController')->except('index','create','update','destroy');

Route::name('reporte.ficha_medica')->get('reporte/ficha_medica/{ficha}', 'ReporteController@ficha_medica');
Route::name('reporte.historial')->get('reporte/historial/{paciente}', 'ReporteController@historial');
?>
