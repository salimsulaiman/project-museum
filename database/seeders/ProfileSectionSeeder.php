<?php

namespace Database\Seeders;

use App\Models\ProfileSection;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProfileSection::insert([
            [
                'content' => '<h3><strong style="color: black;">Museum Maritim Indonesia</strong></h3><p><span style="color: rgb(51, 51, 51);">Terwujudnya Museum Maritim Indonesia yang representatif dan bertaraf internasional sebagai sumber rekreasi, edukasi serta informasi dalam melestarikan dan mengkomunikasikan peranan korporasi serta nilai-nilai budaya bangsa.</span></p>'
            ],
        ]);
    }
}
