<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table = 'proceso';
    protected $primaryKey = 'idProceso';
    use HasFactory;
    protected $fillable = [
        'nombreProceso',
        'prefijo'
    ];
}
