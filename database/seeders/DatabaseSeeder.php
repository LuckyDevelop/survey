<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call([
            RoleSeeder::class,
            ProgramStudiSeeder::class,
            UserSeeder::class,
            PeriodeSeeder::class,
            InputTypeSeeder::class,
            KategoriSeeder::class,
            JenisJawabanSeeder::class,
            ListJawabanSeeder::class,
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}