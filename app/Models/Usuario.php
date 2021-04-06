<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
  protected $table = "empresa_colaboradores";
  use HasFactory;

  protected $fillable = [
    'id_empresa',
    'nombre',
    'apellido_paterno',
    'apellido_materno',
    'area_empresarial',
    'puesto'
  ];
}
