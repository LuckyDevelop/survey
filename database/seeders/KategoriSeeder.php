<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::truncate();
        Kategori::create(
            [
                'kategori_survey'   => 'Survey Penyelenggara Pendidikan',
            ],
            [
                'kategori_survey'   => 'Survey Evaluasi Dosen',
            ],
            [
                'kategori_survey'   => 'Survey Tracer Study',
            ]
        );
    }
}