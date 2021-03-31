<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//tabla de empresa MET,oshun
class Empresa extends Model
{
    use HasFactory;
    protected $fillable = [
      'id',
      'empresa'
    ];
}
