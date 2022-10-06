<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $section = [
            [
                'name'=>'Section A',
                'class_id'=>'6'
            ],
            [
                'name'=>'Section A',
                'class_id'=>'5'
            ],
            [
                'name'=>'Section B',
                'class_id'=>'1'
            ],
            [
                'name'=>'Section C',
                'class_id'=>'6'
            ],
            [
                'name'=>'Section A',
                'class_id'=>'5'
            ],
            [
                'name'=>'Section A',
                'class_id'=>'2'
            ],
        ];
        Section::insert($section);
    }
}
