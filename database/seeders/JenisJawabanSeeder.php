<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\JenisJawaban;

class JenisJawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisJawaban::truncate();
        JenisJawaban::insert([
            [
                'jenis_jawaban'     => 'NPM',
                'input_type_id'     => 5
            ],
            [
                'jenis_jawaban'     => 'Gender',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Tingkat',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Program Studi',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Likert 1',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Likert 2',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Likert 3',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Text Box',
                'input_type_id'     => 2
            ],
            [
                'jenis_jawaban'     => 'Yes or No',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Status Dosen',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Kepuasan',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Status Pegawai',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Jabatan',
                'input_type_id'     => 1
            ],
            [
                'jenis_jawaban'     => 'Persepsi Pelanyanan Tingkat Institusi',
                'input_type_id'     => 1
            ],
        ]);
    }
}