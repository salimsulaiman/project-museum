<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FooterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $sectionId = DB::table('footer_sections')->insertGetId([
            'logo' => null, // bisa diganti path logo kalau ada
            'title' => 'Museum Maritim Indonesia',
            'address' => 'Jl. Pelabuhan No. 9 Tanjung Priok, Jakarta Utara, DKI Jakarta',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Insert ke footer_section_details
        DB::table('footer_section_details')->insert([
            [
                'footer_section_id' => $sectionId,
                'navigation' => 'PELINDO.CO.ID',
                'href' => 'www.pelindo.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'footer_section_id' => $sectionId,
                'navigation' => 'PMLI.CO.ID',
                'href' => 'www.pmli.co.id',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'footer_section_id' => $sectionId,
                'navigation' => 'VIRTUAL MUSEUM',
                'href' => 'https://maritimemuseum.id/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
