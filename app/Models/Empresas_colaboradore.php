<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Colaboradores_telefono as CTel;
use App\Models\Colaboradores_correo as CCor;
use App\Models\Cat_empresas_puesto as CEPue ;
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
      'id_puesto'
    ];

    public function telefonos_ECol()
    {
        return $this->hasMany(CTel::class, 'id_colaborador', 'id');
    }

    public function puesto_ECol()
    {
        return $this->hasOne(CEPue::class, 'id_puesto', 'id');
    }


}
