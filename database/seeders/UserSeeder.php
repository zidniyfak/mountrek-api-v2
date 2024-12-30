<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        User::create([
            'name' => 'Zidniy',
            'email' => 'suratalkausar@gmail.com',
            'phone_numb' => '08123456789',
            'password' => Hash::make('admin123'),
            'img' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        User::create([
            'name' => 'Wahyu',
            'email' => 'cust@gmail.com',
            'phone_numb' => '08123456789',
            'password' => Hash::make('admin123'),
            'img' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
