<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TotalMensual extends Model
{
    use HasFactory;
    protected $table = 'total_mensual'; // Nombre de la tabla en la base de datos
    protected $primaryKey = "id";
    protected $fillable = [ 
        'total',
        'mes',
        'anio',
        'ingreso_total',
        'egreso_total',
        'updated_at',
        'created_at',
    ]; // Campos que se pueden asignar masivamente
}
