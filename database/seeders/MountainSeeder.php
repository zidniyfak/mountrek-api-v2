<?php

namespace Database\Seeders;

use App\Models\Mountain;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MountainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Mountain::create([
            'name' => 'Gunung Andong',
            'location' => 'Kabupaten Magelang',
            'altitude' => 1726,
            'status' => 'Tidak Aktif',
            'type' => 'Strato',
            'lat' => -7.389489075190794,
            'lng' => 110.37032062982256,
            'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique accusantium voluptatibus dolorum a quisquam? Commodi.',
            'img' => null,
        ]);

        Mountain::create([
            'name' => 'Gunung Merbabu',
            'location' => 'Kabupaten Boyolali',
            'altitude' => 3145,
            'status' => 'Aktif',
            'type' => 'Strato',
            'lat' => -7.389489075190794,
            'lng' => 110.37032062982256,
            'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique accusantium voluptatibus dolorum a quisquam? Commodi.',
            'img' => null,
        ]);
    }
}
