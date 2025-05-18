<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'João Paulo Silva Oliveira',
                'email' => 'joao.silva@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Atendente',
            ],
            [
                'name' => 'Maria Clara Santos Ferreira',
                'email' => 'maria.santos@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Atendente',
            ],
            [
                'name' => 'Pedro Henrique Oliveira Costa',
                'email' => 'pedro.oliveira@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Estoque',
            ],
            [
                'name' => 'Ana Beatriz Costa Almeida',
                'email' => 'ana.costa@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Estoque',
            ],
            [
                'name' => 'Carlos Eduardo Souza Lima',
                'email' => 'carlos.souza@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Administrador',
            ],
            [
                'name' => 'Juliana Cristina Pereira Ribeiro',
                'email' => 'juliana.pereira@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Atendente',
            ],
            [
                'name' => 'Roberto Carlos Almeida Gomes',
                'email' => 'roberto.almeida@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Estoque',
            ],
            [
                'name' => 'Fernanda Maria Lima Cardoso',
                'email' => 'fernanda.lima@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Atendente',
            ],
            [
                'name' => 'Marcelo Augusto Rodrigues Pereira',
                'email' => 'marcelo.rodrigues@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Administrador',
            ],
            [
                'name' => 'Patrícia Helena Ferreira Santos',
                'email' => 'patricia.ferreira@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Estoque',
            ],
            [
                'name' => 'Lucas Gabriel Martins Oliveira',
                'email' => 'lucas.martins@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Atendente',
            ],
            [
                'name' => 'Camila Fernandes Gomes Silva',
                'email' => 'camila.gomes@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Administrador',
            ],
            [
                'name' => 'Ricardo José Carvalho Mendes',
                'email' => 'ricardo.carvalho@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Estoque',
            ],
            [
                'name' => 'Amanda Luiza Ribeiro Machado',
                'email' => 'amanda.ribeiro@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Atendente',
            ],
            [
                'name' => 'Paulo Roberto Barbosa Alves',
                'email' => 'paulo.barbosa@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Estoque',
            ],
            [
                'name' => 'Isabela Cristina Andrade Fonseca',
                'email' => 'isabela.andrade@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Atendente',
            ],
            [
                'name' => 'Gustavo Henrique Nunes Peixoto',
                'email' => 'gustavo.nunes@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Administrador',
            ],
            [
                'name' => 'Luciana Aparecida Castro Dias',
                'email' => 'luciana.castro@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Estoque',
            ],
            [
                'name' => 'André Luiz Monteiro Ramos',
                'email' => 'andre.monteiro@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Atendente',
            ],
            [
                'name' => 'Bruna Carolina Moreira Lopes',
                'email' => 'bruna.moreira@exemplo.com.br',
                'password' => Hash::make('senha123'),
                'role' => 'Estoque',
            ]
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}
