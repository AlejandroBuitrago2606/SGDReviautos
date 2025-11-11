<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolDocumento extends Model
{
    protected $table = 'roldocumento';
    protected $primaryKey = 'idDocumento';
    protected $primaryKey = 'idRol';
    use HasFactory;
    protected $fillable = [
        'idRol',
        'idDocumento',
        'acceso'
    ];
}
