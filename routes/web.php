<?php

use Illuminate\Support\Facades\Route;


// use App\Http\Controllers\ConcentradoController;
use App\Http\Controllers\ExcelImportController;
// use App\Http\Controllers\PartidaController;
// use App\Http\Controllers\CapituloController;
// use App\Http\Controllers\AlumnosController;
// use App\Http\Controllers\ClaveController;
// use App\Http\Controllers\ConsulasControlador;
use App\Http\Controllers\HNuevaController;
use App\Http\Controller\ControlDeFacturasController;
use App\Http\Controller\ConsolidadoDeMesesController;
use App\Http\Controller\PolizaDeIngresosController;
use App\Http\Controller\FlujoDeEfectivoController;
use App\Http\Controller\FormatoConciliacionController;
use App\Http\Controller\FinanzasController;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/pdf', function (Codedge\Fpdf\Fpdf\Fpdf $fpdf) {

//     $fpdf->AddPage();
//     $fpdf->SetFont('Courier', 'B', 18);
//     $fpdf->Cell(50, 25, 'Hello World!');
//     $fpdf->Output();
//     exit;

// });



Route::middleware(['auth'])->group(function () {
Route::get('/import-form', [ExcelImportController::class, 'importForm']);
Route::post('/import', [ExcelImportController::class, 'import']);
Route::view('alumno','alumnos/Alumnos');
Route::view('informacion', 'consultas/Consultas');
Route::view('clave', 'clave/clave');

Route::view('con', 'concentrado/concentrado2');
Route::view('finanzas', 'finanzas/totalMensual');

Route::view('capitulo','capitulo/capitulo');
Route::view('partida','partida/partida');
Route::view('descripcion','descripcion/index');

Route::view('descripcion', 'descripcion.index');


Route::view('listConcentrado', 'concentrado/vueConcentrado');
Route::resource('concentrado',ListConcentradoController::class);
// Route::post('guardarConcentrado',[ListConcentradoController::class,'store']);
// rutas apis(controladores)
Route::apiResource('apiAlumno',AlumnosController::class);
Route::apiResource('apiConsulta', ConsulasControlador::class);
Route::apiResource('apiConcentrado', ConcentradoController::class);
Route::apiResource('apiClave', ClaveController::class);
Route::get('apiTotalMes', 'FinanzasController@index');
Route::get('apiEgresos', 'FinanzasController@getEgresos');
Route::get('apiIngresos', 'FinanzasController@getIngresos');
Route::get('/ingresos-por-mes', 'FinanzasController@filtroPorMes');
Route::get('/egresos-por-mes', 'FinanzasController@filtroPorMesE');
Route::get('/total-por-mes', 'FinanzasController@filtroPorMesMT');
Route::get('/ultimo-folio', 'ConsulasControlador@obtenerUltimoFolio');


Route::apiResource('apiPartida',PartidaController::class);
Route::apiResource('apiCapitulo', CapituloController::class);


Route::apiResource('apiDescripcion', DescripcionController::class);
Route::apiResource('apiUsuario', UsuariosController::class);

});

// rutas apis(controladores)

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//PDF
Route::get('Hojapdf', 'HNuevaController@hojares');
// Route::get('Facturapdf', 'ControlDeFacturasController@Facturas');//no sirve 
Route::get('/Consolidadopdf/{anio}/{mes}', 'ConsolidadoDeMesesController@Consolidado');
Route::get('/Polizapdf/{id}', 'PolizaDeIngresosController@Poliza');
Route::get('FlujoDeEfectivopdf', 'FlujoDeEfectivoController@Flujo');
Route::get('Conciliacionpdf','FormatoConciliacionController@Conciliacion');

Route::get('/ControlDeIngresospdf/{id}','ControlDeIngresosController@Ingresos');
//



// Route::get('/ControlDeIngresospdf/{id}','ControlDeIngresosController@Ingresos');//no sirve
Route::get('/Control_De_Ingresospdf/{id}','ControlDeIngresos_Controller@Ingresos');

Route::get('/Factura_pdf/{anio}/{mes}', 'ControlDeFacturas_Controller@Facturas');