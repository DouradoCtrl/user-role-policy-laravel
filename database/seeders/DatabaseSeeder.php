<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Chamar o UserSeeder com nomes reais de pessoas
        $this->call([
            UserSeeder::class,
        ]);
        
        // Criar um usuário de dourado-dev específico
        User::factory()->create([
            'name' => 'dourado-dev',
            'email' => 'dourado@desenvolvimento.com',
            'password' => bcrypt('teste123'),
            'role' => 'Administrador',
        ]);
        
        // Criar um usuário atendente
        User::factory()->create([
            'name' => 'Atendente User',
            'email' => 'atendente@example.com',
            'role' => 'Atendente',
        ]);
        
        // Criar um usuário estoque
        User::factory()->create([
            'name' => 'Estoque User',
            'email' => 'estoque@example.com',
            'role' => 'Estoque',
        ]);
    }
}
