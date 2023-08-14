<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partida extends Model
{
    use HasFactory;
 
    protected $table = 'partida';
    protected $primaryKey = 'id';
    public $with = ['capitulo'];
    public $incrementing=false;
    public $timestamps=false;
    protected $fillable = ['id','codigo','nombre','id_capitulo'];

    public function capitulo(){

        return $this->belongsTo(Capitulo::class, 'id_capitulo', 'id');
    }
}
