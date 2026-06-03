<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\Usuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Este archivo es el seeder principal. Laravel ejecuta este seeder
     * cuando llamas a `php artisan db:seed` o `php artisan migrate:fresh --seed`.
     */
    public function run(): void
    {
        // Llamamos al RolesSeeder para crear los roles necesarios.
        $this->call(RolesSeeder::class);

        // Obtenemos los IDs de los roles
        $adminRole = Rol::where('nombre', 'admin')->first()->id;
        $clienteRole = Rol::where('nombre', 'cliente')->first()->id;

        // Creamos un usuario administrador de ejemplo.
        // firstOrCreate evita que se cree otra vez si el mismo email ya existe.
        Usuario::firstOrCreate(
            ['email' => 'anfran06@gmail.com'],
            [
                'nombre' => 'Administrador',
                'password' => '123456',
                'rol_id' => $adminRole,
            ]
        );

        // Creamos usuarios clientes de ejemplo
        Usuario::firstOrCreate(
            ['email' => 'juan@example.com'],
            [
                'nombre' => 'Juan Pérez',
                'password' => '123456',
                'rol_id' => $clienteRole,
            ]
        );

        Usuario::firstOrCreate(
            ['email' => 'maria@example.com'],
            [
                'nombre' => 'María García',
                'password' => '123456',
                'rol_id' => $clienteRole,
            ]
        );

        Usuario::firstOrCreate(
            ['email' => 'carlos@example.com'],
            [
                'nombre' => 'Carlos López',
                'password' => '123456',
                'rol_id' => $clienteRole,
            ]
        );
    }
}
