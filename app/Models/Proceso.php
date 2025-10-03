<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proceso extends Model
{
    protected $table = 'proceso';
    use HasFactory;
    protected $fillable = [
        'nombreProceso',
        'prefijo'
    ];
}
