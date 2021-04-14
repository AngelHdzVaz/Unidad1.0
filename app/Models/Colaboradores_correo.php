<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cat_empresas_area as CEAre ;
use App\Models\Cat_empresas_puesto as CEPue ;
use App\Models\Colaboradores_telefono as CTel;
use App\Models\Empresa as Emp;
use App\Models\Empresas_colaboradore as ECol;
class Colaboradores_correo extends Model
{
    use HasFactory;
    protected $fillable = [
      'id_colaborador',
      'id_empresa',
      'correo'
    ];

    public function colaborador_CCor(){
      return $this->belongsTo(ECol::class,'id_colaborador','id');
    }

}
