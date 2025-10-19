<?php

namespace Database\Seeders;

use App\Models\TipoUsuario;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoUsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tipos = [
            ['id' => 1, 'tipo' => 'Admin'],
            ['id' => 2, 'tipo' => 'Proprietário'],
            ['id' => 3, 'tipo' => 'Inquilino']
        ];

        foreach ($tipos as $tipo) {
            TipoUsuario::updateOrCreate(['id' => $tipo['id']], $tipo);
        }
    }
}