<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PagoPreinscripcion extends Model
{
    use HasFactory;
    protected $table = "preinscripcion_pagos";
    protected $primaryKey = "id";
    protected $with = ['preinscritos', 'servicios'];

    public $incrementing = \true;
    public $timestamps = \false;

    protected $fillable = [
        'id',
        'id_folio',
        'id_servicio',
        'fecha_pago',
    ];

    public function preinscritos()
    {
        return $this->belongsTo(Preinscripcion::class, 'id_folio');
    }

    public function servicios()
    {
        return $this->belongsTo(Servicio::class, 'id_servicio');
    }
}
