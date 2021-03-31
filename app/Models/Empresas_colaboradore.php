<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Colaboradores_telefono as CTel;
use App\Models\Colaboradores_correo as CCor;
//tabla para colaboradoes
class Empresas_colaboradore extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'id_empresa',
      'nombre',
      'apellido_paterno',
      'apellido_materno',
      'area_empresarial',
      'puesto'
    ];

    public function telefonos_CTel()
    {
        return $this->hasMany(CTel::class, 'id_colaborador', 'id');
    }
}
