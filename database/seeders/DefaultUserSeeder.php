<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Verificar si el usuario admin ya existe
        if (!User::where('email', 'admin@example.com')->exists()) {
            // Crear el usuario admin con rol 'admin'
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'), // Cambia la contraseña si lo deseas
                'rol' => 'admin', // Asignar el rol de admin
            ]);
        }
    }
}
