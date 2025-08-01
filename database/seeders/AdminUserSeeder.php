<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin EssyCoff',
            'email' => 'admin@essycoff.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'aktif',
            'phone' => '081234567890'
        ]);
    }
}