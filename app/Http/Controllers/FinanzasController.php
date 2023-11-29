<?php

namespace App\Http\Controllers;

use App\Models\Egresos;
use App\Models\Ingresos;
use App\Models\TotalMensual;
use Illuminate\Http\Request;

class FinanzasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return TotalMensual::all();

    }

    public function getEgresos()
    {
        //
        return Egresos::all();
        
    }

    public function getIngresos()
    {
        //
        return Ingresos::all();
        
    }

    public function filtroPorMes(Request $request){
        $fecha = $request->input('mes');
        $mes= date('m',strtotime($fecha));
        $anio= date('Y',strtotime($fecha));
        $ingresos = Ingresos::where('mes',$mes)->where('anio',$anio)->get();
        return response()->json($ingresos);
    }

    public function filtroPorMesE(Request $request){
        $fecha = $request->input('mes');
        $mes= date('m',strtotime($fecha));
        $anio= date('Y',strtotime($fecha));
        $egresos = Egresos::where('mes',$mes)->where('anio',$anio)->get();
        return response()->json($egresos);
    }

    public function filtroPorMesMT(Request $request){
        $fecha = $request->input('mes');
        $mes= date('m',strtotime($fecha));
        $anio= date('Y',strtotime($fecha));
        $totalMes = TotalMensual::where('mes',$mes)->where('anio',$anio)->get();
        return response()->json($totalMes);
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
    }
}
