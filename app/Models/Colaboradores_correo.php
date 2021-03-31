<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//Correo de colaboradores
class Colaboradores_correo extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'id_colaborador',
      'correo'
    ];
}
