<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Akun extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'role' => '1',
            'alamat' => 'Admin'
        ]);

        User::create([
            'name' => 'Petugas',
            'email' => 'petugas@gmail.com',
            'password' => bcrypt('password'),
            'role' => '2',
            'alamat' => 'Petugas'
        ]);

        User::create([
            'name' => 'Pelanggan',
            'email' => 'Pelanggan@gmail.com',
            'password' => bcrypt('password'),
            'role' => '3',
            'alamat' => 'Pelanggan'
        ]);
    }

}



