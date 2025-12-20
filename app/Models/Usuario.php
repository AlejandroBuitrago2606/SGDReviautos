<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;


class Usuario extends Authenticatable
{

    protected $table = 'usuario';

    use HasFactory;
    protected $fillable = [
        'nombreUsuario',
        'telefono',
        'email',
        'password',
        'idRol'
    ];

       public function getAuthPassword()
    {
        return $this->password;
    }

}
