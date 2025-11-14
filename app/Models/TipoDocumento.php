<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    protected $table = 'tipodocumento';
    protected $primaryKey = 'idTipoDocumento';
    use HasFactory;
    protected $fillable = [
        'nombreDocumento',
        'prefijo'
    ];

    public function documentos()
    {
        return $this->hasMany(Documento::class, 'idTipoDocumento');
    }
    
}
