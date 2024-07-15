<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ListJawaban;

class ListJawabanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ListJawaban::truncate();
        ListJawaban::insert([
            //Gender
            [
                'jenis_jawaban_id'  => 2,
                'nilai'             => 1,
                'label'             => 'Laki - Laki'
            ],
            [
                'jenis_jawaban_id'  => 2,
                'nilai'             => 2,
                'label'             => 'Perempuan'
            ],
            //Tingkat
            [
                'jenis_jawaban_id'  => 3,
                'nilai'             => 1,
                'label'             => 'I'
            ],
            [
                'jenis_jawaban_id'  => 3,
                'nilai'             => 2,
                'label'             => 'II'
            ],
            [
                'jenis_jawaban_id'  => 3,
                'nilai'             => 3,
                'label'             => 'III'
            ],
            [
                'jenis_jawaban_id'  => 3,
                'nilai'             => 4,
                'label'             => 'IV'
            ],
            //Program Studi
            [
                'jenis_jawaban_id'  => 4,
                'nilai'             => 1,
                'label'             => 'RKS'
            ],
            [
                'jenis_jawaban_id'  => 4,
                'nilai'             => 2,
                'label'             => 'RPK'
            ],
            [
                'jenis_jawaban_id'  => 4,
                'nilai'             => 3,
                'label'             => 'RPLK'
            ],
            [
                'jenis_jawaban_id'  => 4,
                'nilai'             => 4,
                'label'             => 'PSK'
            ],
            //Likert 1
            [
                'jenis_jawaban_id'  => 5,
                'nilai'             => 1,
                'label'             => 'Sangat Baik'
            ],
            [
                'jenis_jawaban_id'  => 5,
                'nilai'             => 2,
                'label'             => 'Baik'
            ],
            [
                'jenis_jawaban_id'  => 5,
                'nilai'             => 3,
                'label'             => 'Cukup'
            ],
            [
                'jenis_jawaban_id'  => 5,
                'nilai'             => 4,
                'label'             => 'Kurang'
            ],
            //Likert 2
            [
                'jenis_jawaban_id'  => 6,
                'nilai'             => 1,
                'label'             => 'Sangat Setuju'
            ],
            [
                'jenis_jawaban_id'  => 6,
                'nilai'             => 2,
                'label'             => 'Setuju'
            ],
            [
                'jenis_jawaban_id'  => 6,
                'nilai'             => 3,
                'label'             => 'Cukup Setuju'
            ],
            [
                'jenis_jawaban_id'  => 6,
                'nilai'             => 4,
                'label'             => 'Kurang Setuju'
            ],
            //Likert 3
            [
                'jenis_jawaban_id'  => 7,
                'nilai'             => 1,
                'label'             => 'Sangat Tidak Penting'
            ],
            [
                'jenis_jawaban_id'  => 7,
                'nilai'             => 2,
                'label'             => 'Tidak Penting'
            ],
            [
                'jenis_jawaban_id'  => 7,
                'nilai'             => 3,
                'label'             => 'Cukup Penting'
            ],
            [
                'jenis_jawaban_id'  => 7,
                'nilai'             => 4,
                'label'             => 'Penting'
            ],
            [
                'jenis_jawaban_id'  => 7,
                'nilai'             => 5,
                'label'             => 'Sangat Penting'
            ],
            //Yes Or No
            [
                'jenis_jawaban_id'  => 9,
                'nilai'             => 1,
                'label'             => 'Yes'
            ],
            [
                'jenis_jawaban_id'  => 9,
                'nilai'             => 2,
                'label'             => 'No'
            ],
            //Status Dosen
            [
                'jenis_jawaban_id'  => 10,
                'nilai'             => 1,
                'label'             => 'Dosen Tetap (Jabfung Dosen)'
            ],
            [
                'jenis_jawaban_id'  => 10,
                'nilai'             => 2,
                'label'             => 'Dosen Tidak Tetap (Dosen Tamu)'
            ],
            //Kepuasan
            [
                'jenis_jawaban_id'  => 11,
                'nilai'             => 1,
                'label'             => 'Sangat Puas'
            ],
            [
                'jenis_jawaban_id'  => 11,
                'nilai'             => 2,
                'label'             => 'Puas'
            ],
            [
                'jenis_jawaban_id'  => 11,
                'nilai'             => 3,
                'label'             => 'Cukup Puas'
            ],
            [
                'jenis_jawaban_id'  => 11,
                'nilai'             => 4,
                'label'             => 'Kurang Puas'
            ],
            //Status Pegawai
            [
                'jenis_jawaban_id'  => 12,
                'nilai'             => 1,
                'label'             => 'PNS'
            ],
            [
                'jenis_jawaban_id'  => 12,
                'nilai'             => 2,
                'label'             => 'PPNPN'
            ],
            // [
            //     'jenis_jawaban_id'  => 12,
            //     'nilai'             => 3,
            //     'label'             => 'Lainnya'
            // ],
            //Jabatan
            [
                'jenis_jawaban_id'  => 13,
                'nilai'             => 1,
                'label'             => 'Fungsional Umum'
            ],
            [
                'jenis_jawaban_id'  => 13,
                'nilai'             => 2,
                'label'             => 'Fungsional Teknis/Tertentu'
            ],
            //Persepsi Pelayanan Tingkat Institusi
            [
                'jenis_jawaban_id'  => 14,
                'nilai'             => 1,
                'label'             => 'Emphaty'
            ],
            [
                'jenis_jawaban_id'  => 14,
                'nilai'             => 2,
                'label'             => 'Tangible'
            ],
            [
                'jenis_jawaban_id'  => 14,
                'nilai'             => 3,
                'label'             => 'Reliability'
            ],
            [
                'jenis_jawaban_id'  => 14,
                'nilai'             => 4,
                'label'             => 'Responsiveness'
            ],
            [
                'jenis_jawaban_id'  => 14,
                'nilai'             => 5,
                'label'             => 'Assurance'
            ],
        ]);
    }
}
