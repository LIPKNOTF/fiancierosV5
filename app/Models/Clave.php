<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clave extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'claves_p';
    protected $primaryKey = 'id';
    public $incrementing=false;
    protected $fillable = ['id','clave','concepto'];
}
