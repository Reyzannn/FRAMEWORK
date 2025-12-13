<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      
        User::create([
            'username' => 'Admin',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
        ]);

         User::create([
            'username' => 'Staff',
            'password' => Hash::make('staff123'),
            'role'     => 'staff',
        ]);

         User::create([
            'username' => 'Owner',
            'password' => Hash::make('owner123'),
            'role'     => 'owner',
        ]);

        User::create([
            'username' => 'Manager',
            'password' => Hash::make('manager123'),
            'role'     => 'manager',
        ]);
    }
}
