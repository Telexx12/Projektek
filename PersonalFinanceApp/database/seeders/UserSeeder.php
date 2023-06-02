<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */



    public function run(): void
    {
        $users = [
            [
                'username' => 'Telexx',
                'email' => 'telegdi.david12@gmail.com',
                'password' => 'fizikaialgebra',
            ],
        ];

        foreach ($users as $user){
            User::create($user);
        }
    }
}
