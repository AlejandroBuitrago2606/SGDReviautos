<?php

namespace Database\Seeders;

use App\Models\TipoDocumento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();

        TipoDocumento::insert([
            [
                'nombreDocumento' => 'Instructivos',
                'prefijo' => 'IN',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nombreDocumento' => 'Procedimientos',
                'prefijo' => 'PR',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nombreDocumento' => 'Manuales',
                'prefijo' => 'MN',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }
}
