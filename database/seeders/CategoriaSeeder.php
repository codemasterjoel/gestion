<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        Categoria::insert([
            ['nombre' => 'ESCUELAS'],
            ['nombre' => 'PARQUES'],
            ['nombre' => 'PLAZAS'],
            ['nombre' => 'SUBESTACIONES ELECTRICA'],
            ['nombre' => 'CENTROS DE SALUD'],
            ['nombre' => 'COMERCIOS'],
            ['nombre' => 'PARADAS DE BUS'],
            ['nombre' => 'CONTENEDORES DE BASURA'],
            ['nombre' => 'ACUMULACIONES DE BASURA'],
            ['nombre' => 'BOTES DE AGUA'],
            ['nombre' => 'ARBOLES PARA PICA Y PODA'],
            ['nombre' => 'FALTA DE LUMINARIA'],
        ]);
    }
}
