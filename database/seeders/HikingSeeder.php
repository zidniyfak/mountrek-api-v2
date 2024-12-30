<?php

namespace Database\Seeders;

use App\Models\Hiking;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HikingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Hiking::create([
            'user_id' => 1,
            'hiking_route_id' => 1,
            'start_date' => '2023-10-10',
            'end_date' => '2023-10-10',
            'numb_of_teams' => 1,
            'desc' => 'lorem ipsum',
            'status' => 'Scheduled',
            'duration' => '00:00:00',
        ]);

        Hiking::create([
            'user_id' => 1,
            'hiking_route_id' => 2,
            'start_date' => '2023-10-10',
            'end_date' => '2023-10-10',
            'numb_of_teams' => 1,
            'desc' => 'lorem ipsum',
            'status' => 'Scheduled',
            'duration' => '00:00:00',
        ]);
    }
}
