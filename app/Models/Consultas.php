<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultas extends Model
{
    use HasFactory;
    protected $table = 'consultas'; // Nombre de la tabla en la base de datos
    protected $primaryKey = "id";
    protected $with = ['alumno'];
    protected $fillable = [
        'id_alumno', 
        'importe', 
        'clave',
        'cantidad',
        'cuota',
        'folio',
        'concepto',
        'fecha'
    ]; // Campos que se pueden asignar masivamente
    public function alumno()
    {
        return $this->belongsTo(Alumnos::class, 'id_alumno');
    }
}
