<?php

// database/seeders/AdminSeeder.php
namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name'     => 'Admin Pesona Prima',
            'no_rumah' => 'A1',
            'no_tlp' => '089553128344',
            'alamat' => 'Blok A1 no 10',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('password123'),
            'role'     => 'admin',
        ]);

        // Contoh 5 user
        $users = [
            [
                'name'     => 'User Satu',
                'no_rumah' => 'B1',
                'no_tlp' => '08976457853',
                'alamat' => 'Blok B1 no 23',
                'email'    => 'user1@gmail.com',
                'password' => Hash::make('user123'),
                'role'     => 'user',
            ],
            [
                'name'     => 'User Dua',
                'no_rumah' => 'B2',
                'no_tlp' => '08976457764',
                'alamat' => 'Blok B2 no 23',
                'email'    => 'user2@gmail.com',
                'password' => Hash::make('user123'),
                'role'     => 'user',
            ],
            [
                'name'     => 'User Tiga',
                'no_rumah' => 'B3',
                'no_tlp' => '08976458812',
                'alamat' => 'Blok B3 no 23',
                'email'    => 'user3@gmail.com',
                'password' => Hash::make('user123'),
                'role'     => 'user',
            ],
            [
                'name'     => 'User Empat',
                'no_rumah' => 'B4',
                'no_tlp' => '08976498812',
                'alamat' => 'Blok B4 no 23',
                'email'    => 'user4@gmail.com',
                'password' => Hash::make('user123'),
                'role'     => 'user',
            ],
            [
                'name'     => 'User Lima',
                'no_rumah' => 'B5',
                'no_tlp' => '08886458812',
                'alamat' => 'Blok B5 no 23',
                'email'    => 'user5@gmail.com',
                'password' => Hash::make('user123'),
                'role'     => 'user',
            ],
        ];
        foreach ($users as $user) {
            User::create($user);
        }
    }

}
