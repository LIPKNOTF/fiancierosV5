<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Descripcion extends Model
{
    use HasFactory;
    protected $table = 'descripcion_partida'; // Nombre de la tabla en la base de datos
    protected $fillable = [
        'id', 
        'id_partida', 
        'descripcion'
       
    ]; // Campos que se pueden asignar masivamente
}
