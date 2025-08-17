<?php

namespace Database\Seeders;

use App\Models\StructureSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StructureSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StructureSection::insert([
            'title' => 'STRUKTUR ORGANISASI MUSEUM MARITIM INDONESIA',
            'image' => null
        ]);
    }
}
