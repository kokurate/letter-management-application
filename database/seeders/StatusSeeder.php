<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        Status::create([
            'status' => 'Pegawai Mengupload Surat'
        ]);

        // 2
        Status::create([
            'status' => 'Kadis Menandatangani Surat Pegawai'
        ]);

        // 3
        Status::create([
            'status' => 'Kadis Mengupload Surat'
        ]);

        // 4
        Status::create([
            'status' => 'Admin Melengkapi Surat'
        ]);
    }
}
