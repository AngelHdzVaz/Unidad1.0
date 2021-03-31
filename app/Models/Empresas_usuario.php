<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//tabla para usuarios de operaciones
class Usuario extends Model
{

  protected $fillable = [
    'id',
    'id_empresa',
    'id_colaborador',
    'usuario',
    'password'
  ];
}
