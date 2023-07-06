<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ConcentradoController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\ListConcentradoController;

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

Route::get('/', function () {
    return view('auth.login');
});



Route::middleware(['auth'])->group(function () {
Route::get('/import-form', [ExcelImportController::class, 'importForm']);
Route::post('/import', [ExcelImportController::class, 'import']);
Route::view('alumno','alumnos/alumnos');
Route::view('consulta', 'consultas/Consultas');
Route::view('clave', 'clave/clave');

Route::view('concentrado', 'concentrado/concentrado');
Route::resource('listConcentrado',ListConcentradoController::class);
Route::post('guardarConcentrado',[ListConcentradoController::class,'store']);
// rutas apis(controladores)
Route::apiResource('apiAlumno',AlumnosController::class);
Route::apiResource('apiConsulta', ConsulasControlador::class);
Route::apiResource('apiConcentrado', ConcentradoController::class);
Route::apiResource('apiClave', ClaveController::class);
});

// rutas apis(controladores)

Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('capitulo','capitulo/capitulo');
Route::view('partida','partida/partida');
Route::apiResource('apiCapitulo',CapituloController::class);
Route::apiResource('apiPartida',PartidaController::class);
