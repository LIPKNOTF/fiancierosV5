<?php

namespace App\Http\Controllers;
use App\Models\Alumnos;
use App\Models\Consultas;
use App\Models\DetalleConsulta;
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

        $detalles=$request->get('detalles');
        DetalleConsulta::insert($detalles);

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
}
