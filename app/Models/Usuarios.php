<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    use HasFactory;

    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['id_usuario','nombre_usuario','apellidoPaterno_usuario','apellidoMaterno_usuario','cargo_usuario'];
}
