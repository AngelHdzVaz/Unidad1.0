<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat_empresas_puesto extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'puesto'
    ];
}
