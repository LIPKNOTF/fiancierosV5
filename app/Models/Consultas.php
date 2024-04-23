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
        'cantidad',
        'folio',
        'fecha',
        'total',
    ]; // Campos que se pueden asignar masivamente
    public function alumno()
    {
        return $this->belongsTo(Alumnos::class, 'id_alumno');
    }

    public function detalleConsulta()
    {
        return $this->hasMany(DetalleConsulta::class, 'id_consulta');
    }

    public function claves_p()
    {
        return $this->belongsTo(Clave::class, 'id_clave');
    }
    
}
