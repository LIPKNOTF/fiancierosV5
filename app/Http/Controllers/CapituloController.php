<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Capitulo;

class CapituloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $capitulo = Capitulo::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $capitulo = new Capitulo();

        $capitulo->id = $request->get('id');
        $capitulo->codigo = $request->get('codigo');
        $capitulo->titulo = $request->get('titulo');

        $capitulo->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $capitulo = Capitulo::find($id);
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
        $capitulo = Capitulo::find($id);

        $capitulo->id = $request->get('id');
        $capitulo->codigo = $request->get('codigo');
        $capitulo->titulo = $request->get('titulo');

        $capitulo->update();
    }
 
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $capitulo = Capitulo::find($id);
        $capitulo->delete();
    }
}
