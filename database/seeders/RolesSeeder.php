<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Run the database seeds.
     *
     * Este seeder crea los roles básicos que usa la aplicación.
     * Los roles se usan en la tabla `roles` y se asocian a los usuarios.
     */
    public function run(): void
    {
        // Definimos los roles que queremos insertar en la tabla.
        $roles = [
            [
                'nombre' => 'admin',
                'descripcion' => 'Administrador',
            ],
            [
                'nombre' => 'cliente',
                'descripcion' => 'Cliente del ecommerce',
            ],
        ];

        foreach ($roles as $rol) {
            // firstOrCreate evita insertar roles duplicados si ejecutamos este seeder varias veces.
            Rol::firstOrCreate(
                ['nombre' => $rol['nombre']],
                $rol
            );
        }
    }
}
