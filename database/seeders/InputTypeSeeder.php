<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\InputType;

class InputTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InputType::truncate();
        InputType::insert([
            [
                'input_type'    => 'radio',
            ],
            [
                'input_type'    => 'textarea',
            ],
            [
                'input_type'    => 'select'
            ],
            [
                'input_type'    => 'checkbox'
            ],
            [
                'input_type'    => 'number'
            ],
        ]);
    }
}