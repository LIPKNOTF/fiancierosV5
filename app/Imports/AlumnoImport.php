<?php

namespace App\Imports;

use App\Models\Alumnos;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class AlumnoImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $nombreCompleto = $row['nombres'];

        // Verificar si el nombre completo comienza con apellidos paternos seguido de apellido materno y nombres
        $partes = explode(' ', $nombreCompleto);

        if (count($partes) >= 3) {
            $apellidoPaterno = $partes[0];
            $apellidoMaterno = $partes[1];
            $nombres = implode(' ', array_slice($partes, 2));
        } else {
            $nombres = $nombreCompleto;
            $apellidoPaterno = '';
            $apellidoMaterno = '';
        }

        return new Alumnos([
            'nombres' => $nombres,
            'apellido_p' => $apellidoPaterno,
            'apellido_m' => $apellidoMaterno,
            'grado' => $row['grado'],
            'grupo' => $row['grupo'],
            'carrera' => $row['carrera'],
            'matricula' => $row['matricula'],
            'turno' => $row['turno'],
            //
        ]);
    }
}
