<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'username' => 'admin',
            'type_id' => 1,
        ]);

        User::create([
            'name' => 'kadis',
            'email' => 'kadis@gmail.com',
            'password' => bcrypt('password'),
            'username' => 'kadis',
            'type_id' => 2,
        ]);

        User::create([
            'name' => 'pegawai',
            'email' => 'pegawai@gmail.com',
            'password' => bcrypt('password'),
            'username' => 'pegawai',
            'type_id' => 3,
        ]);
    }
}
