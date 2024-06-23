<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleConcentrado extends Model
{
    use HasFactory;
    protected $table = 'detalle_concentrado'; // Nombre de la tabla en la base de datos
    protected $primaryKey = "id";
    protected $with = ['concentrado', 'partida'];
    protected $fillable = [
        'id_concentrado',
        'id_partida', 
        'nombre_producto',
        'cantidad',
        'precio_unitario',
        'iva',
        'importe'
    ];


    public function concentrado()
    {
        return $this->belongsTo(Concentrado::class, 'id_concentrado');
    }

    public function partida()
    {
        return $this->belongsTo(Partida::class,'id_partida');
    }
}
