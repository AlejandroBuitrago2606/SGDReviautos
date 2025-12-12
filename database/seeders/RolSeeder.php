<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Rol::insert([
            ['nombreRol' => 'GERENTE GENERAL'],
            ['nombreRol' => 'ASESOR JURIDICO'],
            ['nombreRol' => 'REVISOR FISCAL'],
            ['nombreRol' => 'COORDINADOR DE SISTEMA DE GESTION'],
            ['nombreRol' => 'DIRECTOR TECNICO'],
            ['nombreRol' => 'AUXILIAR DE INSPECCION E INGRESO'],
            ['nombreRol' => 'AUXILIAR DE RUNT'],
            ['nombreRol' => 'AUXILIAR DE GESTION DOCUMENTAL'],
            ['nombreRol' => 'INSPECTOR'],
            ['nombreRol' => 'COORDINADOR DE COMPRAS'],
            ['nombreRol' => 'COORDINADOR DE MANTENIMIENTO'],
            ['nombreRol' => 'COORDINADOR DE SISTEMAS'],
            ['nombreRol' => 'CONTADOR'],
            ['nombreRol' => 'AUXILIAR CONTABLE'],
            ['nombreRol' => 'AUXILIAR DE FACTURACION'],
            ['nombreRol' => 'AUXILIAR DE SEGUROS'],
            ['nombreRol' => 'COORDINADOR ADMINISTRATIVO'],
            ['nombreRol' => 'AUXILIAR DE SERVICIOS GENERALES'],
            ['nombreRol' => 'AUXILIAR DE PATIO'],
            ['nombreRol' => 'COORDINADOR COMERCIAL']
        ]);
    }
}
