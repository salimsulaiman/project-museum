<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@gmail.com',
            'hp' => '081234567890',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
            'profile' => null,
            'role' => 'admin'
        ]);
        
        $this->call(NavbarSeeder::class);
        $this->call(VisitorSeeder::class);
        $this->call(ServiceSeeder::class);
        $this->call(ProfileSectionSeeder::class);
        $this->call(VisionMissionSeeder::class);
        $this->call(StructureSectionSeeder::class);
        $this->call(FooterSeeder::class);
    }
}
