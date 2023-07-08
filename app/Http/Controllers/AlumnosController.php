<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AlumnoImport; // Agrega esta línea
use App\Models\Alumnos;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return $alumnos = Alumnos::all();
      
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
        $alumno = new Alumnos();
        $alumno->id = $request->get('id');
        
        $alumno->matricula = $request->get('matricula');
        $alumno->nombres = $request->get('nombres');
        $alumno->apellido_p = $request->get('apellido_p');
        $alumno->apellido_m = $request->get('apellido_m');
        $alumno->grado = $request->get('grado');
        $alumno->grupo = $request->get('grupo');
        $alumno->carrera = $request->get('carrera');
        $alumno->turno = $request->get('turno');
        $alumno->save();
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
        return Alumnos::find($id);
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
        $alumno = Alumnos::find($id);
        $alumno->id = $request->get('id');
        $alumno->matricula = $request->get('matricula');
        $alumno->nombres = $request->get('nombres');
        $alumno->apellido_p = $request->get('apellido_p');
        $alumno->apellido_m = $request->get('apellido_m');
        $alumno->grado = $request->get('grado');
        $alumno->grupo = $request->get('grupo');
        $alumno->carrera = $request->get('carrera');
        $alumno->turno = $request->get('turno');
        $alumno->update();
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
        $alumno = Alumnos::find($id);

        $alumno->delete();
    }
    public function importForm()
    {
        return view('import');
    }
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xls,xlsx'
        ]);

        $file = $request->file('file');

        Excel::import(new AlumnoImport, $file);

        return redirect()->back()->with('success', 'Datos importados correctamente');
    }
}
