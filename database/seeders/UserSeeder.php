<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        User::truncate();
        User::insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'username' => 'admin',
                'password' => bcrypt('admin1234'),
                'role_id' => 1,
                'no_induk' => null,
                'prodi_id' => null,
                'status_pegawai' => null,
                'jabatan' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Budiono Siregar',
                'email' => 'budiono@gmail.com',
                'no_induk' => '114572',
                'username' => '114572',
                'password' => bcrypt('budiono1234'),
                'role_id' => 2,
                'prodi_id' => 1,
                'status_pegawai' => null,
                'jabatan' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Robert Davis Chaniago',
                'email' => 'robert@gmail.com',
                'no_induk' => '256600',
                'username' => '256600',
                'password' => bcrypt('robert1234'),
                'role_id' => 3,
                'prodi_id' => 1,
                'status_pegawai' => null,
                'jabatan' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'PT Pindad',
                'email' => 'ptpindad@gmail.com',
                'username' => 'ptpindad',
                'password' => bcrypt('ptpindad1234'),
                'role_id' => 4,
                'no_induk' => null,
                'prodi_id' => null,
                'status_pegawai' => null,
                'jabatan' => null,
                'created_at' => $now,
                'updated_at' => $now
            ],
            [
                'name' => 'Bambang Cahyadi',
                'email' => 'bambangcahyadi@gmail.com',
                'no_induk' => '123456',
                'username' => '123456',
                'password' => bcrypt('bambangcahyadi1234'),
                'role_id' => 5,
                'prodi_id' => null,
                'status_pegawai' => 'PNS',
                'jabatan' => 'Fungsional Umum',
                'created_at' => $now,
                'updated_at' => $now
            ],
        ]);
    }
}
