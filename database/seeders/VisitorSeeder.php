<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();
        $startDate = Carbon::now()->subYear();

        $data = [];

        for ($date = $startDate; $date->lte(Carbon::now()); $date->addDay()) {
           
            $visitorCount = rand(5, 20);

            for ($i = 0; $i < $visitorCount; $i++) {
                $data[] = [
                    'ip_address' => $faker->ipv4,
                    'visit_date' => $date->format('Y-m-d'),
                    'created_at' => $date->copy()->setTime(rand(0, 23), rand(0, 59)),
                    'updated_at' => $date->copy()->setTime(rand(0, 23), rand(0, 59)),
                ];
            }
        }

        DB::table('visitors')->insert($data);
    }
}
