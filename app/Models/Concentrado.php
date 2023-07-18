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
        'razon_social_emisor',
        'razon_social_receptor',
        'rfc_emisor',
        'rfc_receptor',
        'regimen_emisor',
        'regimen_receptor',
        'total',
        'sub_total',
        'impuesto_traslado',
        'impuesto_retenido',
        'productos',
        'descripcion',
    ]; 

    public function partida(){

        return $this->belongsTo(Partida::class, 'id_partida', 'id');
    }
}
