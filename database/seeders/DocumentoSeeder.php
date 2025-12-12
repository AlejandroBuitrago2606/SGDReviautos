<?php

namespace Database\Seeders;

use Dom\Document;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Documento;

class DocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = now();

        Documento::insert([
            [
                'consecutivo'              => '02',
                'nombre'                   => 'Cartilla de Inducción',
                'fechaCreacion'            => '2017-08-01',
                'fechaVersion'             => '2025-02-03',
                'n_version'                => 5,
                'fechaRevision'            => '2025-02-03',
                'n_revision'               => 5,
                'n_version_actualizada'    => 4,
                'numeral'                  => null,
                'observaciones'            => 'Se actualizan vision, politica y objetivos de seguridad vial, objetivos de calidad, politica de imparcialidad, politica de consumo de alcohol y drogas.',
                'responsable'              => 'GERENTE GENERAL',
                'rutaArchivo'              => 'documentos/mi_archivo.pdf',
                'idProceso'                => 2,
                'idTipoDocumento'          => 3,
                'created_at'               => $now,
                'updated_at'               => $now,
            ],
        ]);
    }
}
