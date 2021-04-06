<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cat_empresas_area as CEAre ;
use App\Models\Cat_empresas_puesto as CEPue ;
use App\Models\Colaboradores_telefono as CTel;
use App\Models\Colaboradores_correo as CCor;
use App\Models\Empresa as Emp;

class Empresas_colaboradore extends Model
{
    use HasFactory;
    protected $fillable = [
      'id_empresa',
      'nombre',
      'apellido_paterno',
      'apellido_materno',
      'id_area_empresarial',
      'id_puesto'
    ];

    public function area_ECol()
    {
      return $this->hasOne(CEAre::class, 'id', 'id_area_empresarial');
    }

    public function puesto_ECol()
    {
        return $this->hasOne(CEPue::class, 'id', 'id_puesto');
    }
    public function telefonos_ECol()
    {
        return $this->hasMany(CTel::class, 'id_colaborador', 'id');
    }

    public function correos_ECol()
    {
        return $this->hasMany(CCor::class, 'id_colaborador', 'id');
    }
}
