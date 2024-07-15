<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Periode;

class PeriodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Periode::truncate();
        Periode::create([
            'periode'   => '2023/2024 - 1',
            'semester'  => 'gasal'
        ]);
    }
}
