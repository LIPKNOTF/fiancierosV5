<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingresos extends Model
{
    use HasFactory;
    protected $table = 'ingresos'; // Nombre de la tabla en la base de datos
    protected $primaryKey = "id";
    protected $with = ['claves_p'];
    protected $fillable = [
        'id_clave', 
        'total',
        'mes',
        'anio',
        'updated_at',
        'created_at',
    ]; // Campos que se pueden asignar masivamente
    public function claves_p()
    {
        return $this->belongsTo(Clave::class, 'id_clave');
    }
}
