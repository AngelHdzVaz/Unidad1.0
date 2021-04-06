<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Colaboradores_correo extends Model
{
    use HasFactory;
    protected $fillable = [
      'id_colaborador',
      'id_empresa',
      'correo'
    ];
}
