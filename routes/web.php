<?php
use App\Http\Controllers\ConsulasControlador;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlumnosController;
use App\Http\Controllers\ExcelImportController;
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




Route::get('/import-form', [ExcelImportController::class, 'importForm']);
Route::post('/import', [ExcelImportController::class, 'import']);
Route::view('alumno','alumnos/alumnos');
Route::view('consulta', 'consultas/Consultas');
// rutas apis(controladores)
Route::apiResource('apiAlumno',AlumnosController::class);
Route::apiResource('apiConsulta', ConsulasControlador::class);
Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


