<?php

namespace App\Http\Controllers;

use App\Models\Clave;
use Illuminate\Http\Request;

class ClaveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $claves = Clave::all();

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
        $clave = new Clave();
        $clave -> id = $request->get('id');
        $clave -> clave = $request->get('clave');
        $clave-> concepto =$request->get('concepto');
        $clave-> precio =$request->get('precio');
        $clave ->save();


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
        return Clave::find($id);
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
        $clave = Clave::find($id);
        $clave -> id = $request->get('id');
        $clave -> clave = $request->get('clave');
        $clave-> concepto =$request->get('concepto');
        $clave-> precio =$request->get('precio');
        $clave -> update();
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
        $clave = Clave::find($id);
        $clave ->delete();
    }
}
