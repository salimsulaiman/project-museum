<?php

namespace Database\Seeders;

use App\Models\VisionMission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VisionMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        VisionMission::insert([
            [
                'content' => '<h3><strong style="color: black;">VISI</strong></h3><p><span style="color: rgb(51, 51, 51);">Terwujudnya Museum Maritim Indonesia yang representatif dan bertaraf internasional sebagai sumber rekreasi, edukasi serta informasi dalam melestarikan dan mengkomunikasikan peranan korporasi serta nilai-nilai budaya bangsa.</span></p><h3><strong style="color: black;">MISI</strong></h3><ol><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="color: rgb(51, 51, 51);">Mewujudkan pengelolaan koleksi sesuai standar internasional.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="color: rgb(51, 51, 51);">Meningkatkan sarana promosi dan motivasi generasi muda dalam rangka mewujudkan Indonesia sebagai poros maritim dunia.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="color: rgb(51, 51, 51);">Meningkatkan pemahaman sejarah dan nilai budaya kemaritiman dalam memperkuat jati diri Indonesia sebagai negara maritim terbesar di dunia.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="color: rgb(51, 51, 51);">Melestarikan dan mengembangkan Museum Maritim Indonesia secara berkelanjutan dalam rangka memberikan informasi yang lengkap untuk tujuan pendidikan dan rekreasi.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="color: rgb(51, 51, 51);">Mengkomunikasikan identitas, peranan dan kontribusi korporasi terhadap pembangunan negeri.</span></li><li data-list="bullet"><span class="ql-ui" contenteditable="false"></span><span style="color: rgb(51, 51, 51);">Memberikan fasilitas kepada pegawai Pelindo Grup dan publik dalam melakukan riset dan mengembangkan pengetahuan kepelabuhanan, maritim dan pelayaran nusantara melalui perpustakaan dan museum.</span></li></ol>'
            ],
        ]);
    }
}
