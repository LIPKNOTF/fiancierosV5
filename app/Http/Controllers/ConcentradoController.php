<?php

namespace App\Http\Controllers;

use App\Models\Concentrado;
use App\Models\Egresos;
use Illuminate\Http\Request;

class ConcentradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return Concentrado::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
            
            $concentrado= new Concentrado();
            $concentrado->id_partida = $request->get('id_partida');
            $concentrado->fecha = $request->get('fecha');
            $concentrado->razon_social_emisor = $request->get('razon_social_emisor');
            $concentrado->razon_social_receptor = $request->get('razon_social_receptor');
            $concentrado->rfc_emisor = $request->get('rfc_emisor');
            $concentrado->rfc_receptor = $request->get('rfc_receptor');
            $concentrado->regimen_emisor = $request->get('regimen_emisor');
            $concentrado->regimen_receptor = $request->get('regimen_receptor');
            $concentrado->total = $request->get('total');
            $concentrado->sub_total = $request->get('sub_total');
            $concentrado->impuesto_traslado = $request->get('impuesto_traslado');
            $concentrado->impuesto_retenido = $request->get('impuesto_retenido');
            $concentrado->productos = $request->get('productos');
            $concentrado->descripcion = $request->get('descripcion');
            $concentrado->save();
    
            // Guardamos la partida, el total y la fecha en la tabla de egresos 
            
            $detalles=$request->get('egresos');
            Egresos::inser($detalles);
        
        
       
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return $concentrado = Concentrado::find($id);
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
        $concentrado = Concentrado::find($id);
        $concentrado->id_partida = $request->get('id_partida');
        $concentrado->fecha = $request->get('fecha');
        $concentrado->razon_social_emisor = $request->get('razon_social_emisor');
        $concentrado->razon_social_receptor = $request->get('razon_social_receptor');
        $concentrado->rfc_emisor = $request->get('rfc_emisor');
        $concentrado->rfc_receptor = $request->get('rfc_receptor');
        $concentrado->regimen_emisor = $request->get('regimen_emisor');
        $concentrado->regimen_receptor = $request->get('regimen_receptor');
        $concentrado->total = $request->get('total');
        $concentrado->sub_total = $request->get('sub_total');
        $concentrado->impuesto_traslado = $request->get('impuesto_traslado');
        $concentrado->impuesto_retenido = $request->get('impuesto_retenido');
        $concentrado->productos = $request->get('productos');
        $concentrado->descripcion = $request->get('descripcion');
        $concentrado->update();
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
        $concentrado = Concentrado::find($id);
        $concentrado->delete();
    }
}
