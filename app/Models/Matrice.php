<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matrice extends Model
{
    use HasFactory;
    protected $fillable = [
      'nombre'
    ];
    public function matriz_MEmp()
    {
      return $this->hasOne(CEAre::class, 'id', 'id_matriz');
    }
}
