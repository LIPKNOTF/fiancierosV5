<?php

namespace App\Http\Controllers;
use App\Models\Alumnos;
use App\Models\Consultas;
use App\Models\DetalleConsulta;
use App\Models\Ingresos;
use App\Models\TotalMensual;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ConsulasControlador extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $consulta = Consultas::all();
        return $consulta;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $consulta = new Consultas();
        $consulta->id = $request->get('id');
        $consulta->id_alumno = $request->get('id_alumno');
        
        $consulta->cantidad = $request->get('cantidad');
        
        $consulta->fecha = $request->get('fecha');
        $consulta->folio = $request->get('folio');
        $consulta->id_clave = $request->get('id_clave');
        $consulta->total = $request->get('total');
        $consulta->save();

        // $detalles=$request->get('detalles');
        // DetalleConsulta::insert($detalles);

        $ingresoData = $request->get('detalles');

        foreach ($ingresoData as $ingreso) {
            // Recupero los datos individuales en caso de que sea mas de un pago 
            $idClave = $ingreso['id_clave'];
            $total = $ingreso['total'];


            $fecha = Carbon::parse($ingreso['fecha']);
            $mes = $fecha->month;
            $anio = $fecha->year;

            // en caso de que la partida ya esté registrada lo que procede es validar
            $ingresoExistente = Ingresos::where('id_clave', $idClave)
            ->where('mes',$mes)
            ->where('anio',$anio)
            ->first();

            if ($ingresoExistente) {
                // Si existe el registro, actualiza el valor del total
                $ingresoExistente->total += $total;
                // Actualiza otros campos si es necesario...
                $ingresoExistente->save();
            } else {
                Ingresos::create([
                    'id_clave' => $idClave,
                    'total' => $total,
                    'mes' => $mes,
                    'anio' => $anio
                ]);
            }


            
        }

        $totalMensualData=$request->get('ingresos');
        
        foreach($totalMensualData as $totalMes){
            $fecha = Carbon::parse($totalMes['fecha']);
            $mes = $fecha->month;
            $anio = $fecha->year;
            $totalMensual = TotalMensual::where('mes',$mes)->where('anio',$anio)->first();

            if($totalMensual){
                $totalMensual->ingreso_total += $totalMes['total'];
                $totalMensual->save();
            }else {
                TotalMensual::create([
                    'mes'=>$mes,
                    'anio'=>$anio,
                    'ingreso_total'=>$totalMes['total']
                ]);
            }
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        return Consultas::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $consulta = Consultas::find($id);
        $consulta->id = $request->get('id');
        $consulta->id_alumno = $request->get('id_alumno');
        $consulta->importe = $request->get('importe');
        $consulta->cantidad = $request->get('cantidad');
        $consulta->cuota = $request->get('cuota');
        $consulta->fecha = $request->get('fecha');
        $consulta->folio = $request->get('folio');
        $consulta->id_clave = $request->get('id_clave');
        $consulta->total = $request->get('total');
        $consulta->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $consulta = Consultas::find($id);
        $consulta->delete();
    }

    public function obtenerUltimoFolio(){
        $ultimaConsulta = Consultas::latest('folio')->first();

        if ($ultimaConsulta) {
            // Obtener el número del folio eliminando los espacios en blanco
            $numeroFolio = (int)str_replace(' ', '', explode(' ', $ultimaConsulta->folio)[1]);

            return $numeroFolio;
        } else {
            return null;
        }
    }

}
