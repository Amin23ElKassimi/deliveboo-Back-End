<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $users = [
            [
                'name' => 'John',
                'last_name' => 'Doe',
                'email' => 'john@example.com',
                'password' => bcrypt('password123'),
            ],
            [
                'name' => 'Jane',
                'last_name' => 'Smith',
                'email' => 'jane@example.com',
                'password' => bcrypt('password456'),
            ],
            [
                'name' => 'Michael',
                'last_name' => 'Johnson',
                'email' => 'michael@example.com',
                'password' => bcrypt('password789'),
            ],
            [
                'name' => 'Emily',
                'last_name' => 'Brown',
                'email' => 'emily@example.com',
                'password' => bcrypt('passwordABC'),
            ],
            [
                'name' => 'David',
                'last_name' => 'Williams',
                'email' => 'david@example.com',
                'password' => bcrypt('passwordDEF'),
            ],
            [
                'name' => 'Cristiano',
                'last_name' => 'Ronaldo',
                'email' => 'alfa@gmail.com',
                'password' => bcrypt('123456'),
            ],
        ];


        // Inserisci i dati nel database
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
