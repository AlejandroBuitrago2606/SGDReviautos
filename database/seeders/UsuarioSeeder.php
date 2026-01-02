<?php

namespace Database\Seeders;

use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $now = now();

        Usuario::insert([
            [
                'nombreUsuario' => 'Lina Maria Ayala',
                'telefono'       => '3132000062',
                'correo'         => 'ayalalinamaria@gmail.com',
                'clave'          => '$2y$10$H98VYREKg68Mop/YzW26.OziTRInLfmScs8CIkvSogZ8wcL212Pja',
                'idRol'          => 4,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'nombreUsuario' => 'Yuber Alejandro Buitrago Gonzalez',
                'telefono'       => '3166301513',
                'correo'         => 'alejo.yb06@gmail.com',
                'clave'          => '$2y$10$H98VYREKg68Mop/YzW26.OziTRInLfmScs8CIkvSogZ8wcL212Pja',
                'idRol'          => 6,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'nombreUsuario' => 'Yuribel Chauta Caicedo',
                'telefono'       => '3115064746',
                'correo'         => 'yurichauta@gmail.com',
                'clave'          => '$2y$10$H98VYREKg68Mop/YzW26.OziTRInLfmScs8CIkvSogZ8wcL212Pja',
                'idRol'          => 17,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'nombreUsuario' => 'Brayan David Cortes Cataño',
                'telefono'       => '3212975843',
                'correo'         => 'brayanjaja.05@gmail.com',
                'clave'          => '$2y$10$H98VYREKg68Mop/YzW26.OziTRInLfmScs8CIkvSogZ8wcL212Pja',
                'idRol'          => 6,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
            [
                'nombreUsuario' => 'Elias Estepa Monsalve',
                'telefono'       => '3134590389',
                'correo'         => 'eliesmo2016@gmail.com',
                'clave'          => '$2y$10$H98VYREKg68Mop/YzW26.OziTRInLfmScs8CIkvSogZ8wcL212Pja',
                'idRol'          => 1,
                'created_at'     => $now,
                'updated_at'     => $now,
            ],
        ]);
    }
}
