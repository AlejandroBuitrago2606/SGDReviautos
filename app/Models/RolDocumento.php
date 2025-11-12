<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class RolDocumento extends Model
{
    use HasCompositeKey;

    protected $table = 'roldocumento';
    protected $primaryKey = ['idDocumento', 'idRol'];
    public $incrementing = false;


    use HasFactory;
    protected $fillable = [
        'idDocumento',
        'idRol',
        'acceso'
    ];
}
