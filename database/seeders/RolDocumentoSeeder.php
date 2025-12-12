<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RolDocumento;

class RolDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        RolDocumento::insert([
            ['idDocumento' => 1, 'idRol' => 4, 'acceso' => 0]
        ]);
    }
}
