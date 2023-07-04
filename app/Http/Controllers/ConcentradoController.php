<?php

namespace App\Http\Controllers;

use App\Models\Concentrado;
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
        //
        $concentrado= new Concentrado();
        $concentrado->id_partida = $request->get('id_partida');
        $concentrado->fecha = $request->get('fecha');
        $concentrado->razon_social = $request->get('razon_social');
        $concentrado->rfc = $request->get('rfc');
        $concentrado->monto = $request->get('monto');
        $concentrado->productos = $request->get('productos');
        $concentrado->save();
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
        $concentrado->razon_social = $request->get('razon_social');
        $concentrado->rfc = $request->get('rfc');
        $concentrado->monto = $request->get('monto');
        $concentrado->productos = $request->get('productos');
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
