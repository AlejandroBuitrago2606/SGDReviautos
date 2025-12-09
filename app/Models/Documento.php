<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    protected $table = 'documento';

    use HasFactory;
    protected $fillable = [
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

    public function tipoDocumento()
    {
        return $this->belongsTo(TipoDocumento::class, 'idTipoDocumento');
    }
}
