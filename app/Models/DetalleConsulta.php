<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleConsulta extends Model
{
    use HasFactory;
    protected $table = 'detalle_consulta'; // Nombre de la tabla en la base de datos
    protected $primaryKey = "id";
    protected $with = ['claves_p', 'consulta'];
    protected $fillable = [
        'id_clave',
        'id_consulta', 
        'total',
        'cantidad'
    ]; 
    

    public function claves_p()
    {
        return $this->belongsTo(Clave::class, 'id_clave');
    }

    public function consulta()
    {
        return $this->belongsTo(Consultas::class,'id_consulta');
    }
}
