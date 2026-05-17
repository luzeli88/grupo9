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

        // Creamos un usuario administrador de ejemplo.
        // firstOrCreate evita que se cree otra vez si el mismo email ya existe.
        Usuario::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'nombre' => 'Administrador',
                // El password se guarda como texto plano aquí solo para ejemplo,
                // el modelo Usuario debe aplicar el hash automáticamente.
                'password' => 'password',
                'rol_id' => Rol::where('nombre', 'admin')->first()->id,
            ]
        );
    }
}
