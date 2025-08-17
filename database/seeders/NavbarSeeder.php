<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NavbarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sectionId = DB::table('navbar_sections')->insertGetId([
            'title' => 'PELINDO MUSEUM',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tambahkan beberapa link
        DB::table('navbar_links')->insert([
            [
                'navbar_section_id' => $sectionId,
                'navigation' => 'Beranda',
                'href' => '/',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'navbar_section_id' => $sectionId,
                'navigation' => 'Tentang Kami',
                'href' => '/tentang-kami',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'navbar_section_id' => $sectionId,
                'navigation' => 'Berita',
                'href' => '/berita',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'navbar_section_id' => $sectionId,
                'navigation' => 'Kegiatan',
                'href' => '/kegiatan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'navbar_section_id' => $sectionId,
                'navigation' => 'Koleksi',
                'href' => '/koleksi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'navbar_section_id' => $sectionId,
                'navigation' => 'Publikasi',
                'href' => '/publikasi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
