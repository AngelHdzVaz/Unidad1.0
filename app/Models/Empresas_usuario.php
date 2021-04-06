<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

//Authenticatable es para permitir logeo manual y de laravel
class Usuario extends Authenticatable
{
  //Nitifiable notificaciones en tiempo real
  use HasFactory, Notifiable;

  protected $fillable = [
    'id_empresa',
    'id_colaborador',
    'usuario',
    'password'
  ];
}
