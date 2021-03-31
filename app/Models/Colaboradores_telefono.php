<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//TABLA DE TELEFONOS COLABORADORES
class Colaboradores_telefono extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'id_colaborador',
      'telefono'
    ];
}
