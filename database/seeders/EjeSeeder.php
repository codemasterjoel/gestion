<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eje;

class EjeSeeder extends Seeder
{
    public function run(): void
    {
        Eje::insert([
            ['nombre' => 'EJE 1'],
            ['nombre' => 'EJE 2'],
            ['nombre' => 'EJE 3'],
            ['nombre' => 'EJE 4'],
            ['nombre' => 'EJE 5'],
            ['nombre' => 'EJE 6'],
            ['nombre' => 'EJE 7'],
            ['nombre' => 'EJE 8'],
            ['nombre' => 'EJE 9'],
            ['nombre' => 'EJE 10'],
            ['nombre' => 'EJE 11'],
            ['nombre' => 'EJE 12'],
            ['nombre' => 'EJE 13'],
            ['nombre' => 'EJE 14'],
            ['nombre' => 'EJE 15'],
            ['nombre' => 'EJE 16'],
            ['nombre' => 'EJE 17'],
            ['nombre' => 'EJE 18'],
            ['nombre' => 'EJE 19']
        ]);        
    }
}
