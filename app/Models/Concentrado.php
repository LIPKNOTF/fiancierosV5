<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Concentrado extends Model
{
    use HasFactory;
    protected $table = 'concentrado'; // Nombre de la tabla en la base de datos
    protected $fillable = [
        'id',
        'id_partida',
        'fecha',
        'razon_social',
        'rfc',
        'monto',
        'productos'
    ]; 

    public function partida(){

        return $this->belongsTo(Partida::class, 'id_partida', 'id');
    }
}
