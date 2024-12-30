<?php

namespace Database\Seeders;

use App\Models\HikingRoute;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HikingRouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        HikingRoute::create([
            'mountain_id' => 1,
            'name' => 'Sawit',
            'status' => 'Buka',
            'difficulty' => 'Mudah',
            'location' => 'Kab. Magelang',
            'distance' => 1,
            'duration' => 1,
            'operating_hours' => '24 Jam',
            'numb_of_posts' => 3,
            'contact' => '098765431234',
            'fee' => 25000,
            'lat' => -7.600232,
            'lng' => 110.248586,
            'rules' => 'tidak ada',
        ]);

        HikingRoute::create([
            'mountain_id' => 1,
            'name' => 'Pendem',
            'status' => 'Buka',
            'difficulty' => 'Mudah',
            'location' => 'Kab. Magelang',
            'distance' => 1,
            'duration' => 1,
            'operating_hours' => '24 Jam',
            'numb_of_posts' => 3,
            'contact' => '098765431234',
            'fee' => 25000,
            'lat' => -7.600232,
            'lng' => 110.248586,
            'rules' => 'tidak ada',
        ]);

        HikingRoute::create([
            'mountain_id' => 1,
            'name' => 'Gogik',
            'status' => 'Buka',
            'difficulty' => 'Mudah',
            'location' => 'Kab. Magelang',
            'distance' => 1,
            'duration' => 1,
            'operating_hours' => '24 Jam',
            'numb_of_posts' => 3,
            'contact' => '098765431234',
            'fee' => 25000,
            'lat' => -7.600232,
            'lng' => 110.248586,
            'rules' => 'Tidak ada',
        ]);
    }
}
