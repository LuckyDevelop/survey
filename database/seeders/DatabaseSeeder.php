<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ProgramStudi;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::create([
            'role'  => 'admin'
        ]);
        Role::create([
            'role'  => 'dosen'
        ]);
        Role::create([
            'role'  => 'mahasiswa'
        ]);

        ProgramStudi::create([
            'program_studi' => 'Teknik Informatika'
        ]);

        User::create([
            'name'      =>  'Admin',
            'email'     =>  'admin@gmail.com',
            'no_induk'  =>  '1234',
            'password'  =>  bcrypt('1234'),
            'role_id'   =>  1,
            'prodi_id'  =>  1,
        ]);
        User::create([
            'name'      =>  'Budiono Siregar',
            'email'     =>  'budiono@gmail.com',
            'no_induk'  =>  '114572',
            'password'  =>  bcrypt('1234'),
            'role_id'   =>  2,
            'prodi_id'  =>  1,
        ]);
        User::create([
            'name'      =>  'Robert Davis Chaniago',
            'email'     =>  'robert@gmail.com',
            'no_induk'  =>  '256600',
            'password'  =>  bcrypt('1234'),
            'role_id'   =>  3,
            'prodi_id'  =>  1,
        ]);
    }
}
