<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documento';
    protected $primaryKey = 'idDocumento';
    
    use HasFactory;
    protected $fillable = [
        'idDocumento',
        'consecutivo',
        'nombre',
        'fechaCreacion',
        'fechaVersion',
        'n_version',
        'fechaRevision',
        'n_revision',
        'n_version_actualizada',
        'numeral',
        'observaciones',
        'responsable',
        'rutaArchivo',
        'idProceso',
        'idTipoDocumento'
    ];

    //Agregar campo 'responsable'
    
}
