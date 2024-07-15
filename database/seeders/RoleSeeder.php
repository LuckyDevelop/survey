<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::truncate();
        Role::insert([
            [
                'role'  => 'admin',
            ],
            [
                'role'  => 'dosen',
            ],
            [
                'role'  => 'mahasiswa',
            ],
            [
                'role'  => 'unit kerja',
            ],
            [
                'role'  => 'tenaga pendidik'
            ]
        ]);
    }
}
