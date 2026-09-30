<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

// use Spatie\Permission\Models\Role;
// use Spatie\Permission\Models\Permission;
// use Spatie\Permission\Traits\HasRole;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        User::insert([
            ['name' => 'ADMINISTRADOR', 'email' => 'admin@email.com','password' => bcrypt('21246813'), 'is_admin' => true, 'is_active' => true],
        ]);

        // $user = User::Where('email', '=', 'admin@email.com')->get();
        // $user->assignRole('Admin');
    }
}
