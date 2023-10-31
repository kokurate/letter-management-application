<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Type::create([
            'name' => 'Admin',
        ]);
        
        // 2
        Type::create([
            'name' => 'Kadis',
        ]);

        // 3 
        Type::create([
            'name' => 'Pegawai',
        ]);

    }
}
