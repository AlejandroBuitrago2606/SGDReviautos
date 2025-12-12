<?php

namespace Database\Seeders;

use App\Models\Proceso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        Proceso::insert([
            [
                'nombreProceso' => 'Gestión y planeación estrategica',
                'prefijo' => 'GP',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'nombreProceso' => 'Gestión del Talento Humano',
                'prefijo' => 'GT',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'nombreProceso' => 'Inspección técnico mecánica y de emisiones contaminantes',
                'prefijo' => 'TM',
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'nombreProceso' => 'Mercadeo y publicidad',
                'prefijo' => 'MP',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
