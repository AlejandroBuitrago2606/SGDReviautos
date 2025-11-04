<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolDocumento extends Model
{
    protected $table = 'roldocumento';
    use HasFactory;
    protected $fillable = [
        'idRol',
        'idDocumento',
        'acceso'
    ];
}
