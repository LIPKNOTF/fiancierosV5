<?php

namespace App\Http\Controllers;

use App\Models\Concentrado;
use App\Models\Partida;
use Illuminate\Http\Request;

class ListConcentradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $partidas = Partida::all();
        $concentrados = Concentrado::select('concentrado.id','id_partida','fecha','razon_social_emisor','razon_social_receptor','rfc_emisor','rfc_receptor','regimen_emisor','regimen_receptor','total','sub_total','impuesto_traslado','impuesto_retenido','productos','descripcion','codigo','nombre')->join('partida','partida.id','=','concentrado.id_partida')->get();
        return view('concentrado.concentrado',compact('concentrados','partidas'));
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
        $request->validate([
            'id_partida'=>'required',
            'descripcion'=>'required|max:250',
        ],
        [
            'id_partida.required'=>'El campo Partida es obligatorio',
            'descripcion.required'=>'El campo Descripcion es obligatorio',
        ]);
        $concentrado = new Concentrado();
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

        return back()->with('success','Concentrado Validado con Exito');
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
