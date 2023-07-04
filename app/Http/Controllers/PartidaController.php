<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Partida;

class PartidaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $partida = Partida::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $partida = new Partida();

        $partida->id = $request->get('id');
        $partida->codigo = $request->get('codigo');
        $partida->nombre = $request->get('nombre');
        $partida->id_capitulo = $request->get('id_capitulo');

        $partida->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $partida = Partida::find($id);
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
        $partida = Partida::find($id);

        $partida->id = $request->get('id');
        $partida->codigo = $request->get('codigo');
        $partida->nombre = $request->get('nombre');

        $partida->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $partida = Partida::find($id);
        $partida->delete();
    }
}
