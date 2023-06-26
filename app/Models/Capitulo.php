<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capitulo extends Model
{
    use HasFactory;

    protected $table = 'capitulo';
    protected $primaryKey = 'id';
    public $incrementing=false;
    public $timestamps=false;
    protected $fillable = ['id','codigo','titulo'];
}
