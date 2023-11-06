<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Usuarios;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $usuarios = Usuarios::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $usuarios = new Usuarios();

        $usuarios->id_usuario=$request->get('id_usuario');
        $usuarios->nombre_usuario=$request->get('nombre_usuario');
        $usuarios->apellidoPaterno_usuario=$request->get('apellidoPaterno_usuario');
        $usuarios->apellidoMaterno_usuario=$request->get('apellidoMaterno_usuario');
        $usuarios->cargo_usuario=$request->get('cargo_usuario');

        $usuarios->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $usuarios = Usuarios::find($id);
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
        $usuarios = Usuarios::find($id);+

        $usuarios->id_usuario=$request->get('id_usuario');
        $usuarios->nombre_usuario=$request->get('nombre_usuario');
        $usuarios->apellidoPaterno_usuario=$request->get('apellidoPaterno_usuario');
        $usuarios->apellidoMaterno_usuario=$request->get('apellidoMaterno_usuario');
        $usuarios->cargo_usuario=$request->get('cargo_usuario');

        $usuarios->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $usuarios = Usuarios::find($id);
        $usuarios->delete();
    }
}
