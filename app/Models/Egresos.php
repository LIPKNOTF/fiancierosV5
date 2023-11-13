<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Egresos extends Model
{
    use HasFactory;
    protected $table = 'egresos'; // Nombre de la tabla en la base de datos
    protected $primaryKey = "id";
    protected $with = ['partida'];
    protected $fillable = [
        'id_partida', 
        'total'
    ]; // Campos que se pueden asignar masivamente
    public function partida()
    {
        return $this->belongsTo(Partida::class, 'id_partida');
    }
    
}
