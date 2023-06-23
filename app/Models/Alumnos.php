<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumnos extends Model
{
    use HasFactory;
    protected $table = 'alumnos'; // Nombre de la tabla en la base de datos
    protected $fillable = [
        'nombres', 
        'apellido_p', 
        'apellido_m',
        'grado',
        'grupo',
        'carrera',
        'matricula',
        'turno',
    ]; // Campos que se pueden asignar masivamente
}
