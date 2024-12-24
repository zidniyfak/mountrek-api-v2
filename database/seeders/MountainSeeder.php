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
        // $table->string('name', 50);
        // $table->string('location', 50);
        // $table->integer('altitude')->default(0);
        // $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Tidak Aktif');
        // $table->string('type', 50)->default("-");
        // $table->decimal('lat', 20, 15)->default(0.0);
        // $table->decimal('long', 20, 15)->default(0.0);
        // $table->text('desc')->nullable();
        // $table->string('img')->nullable();

        Mountain::create([
            'name' => 'Gunung Andong',
            'location' => 'Kabupaten Magelang',
            'altitude' => 1726,
            'status' => 'Tidak Aktif',
            'type' => 'Stratovolcano',
            'lat' => -7.389489075190794,
            'long' => 110.37032062982256,
            'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique accusantium voluptatibus dolorum a quisquam? Commodi.',
        ]);
    }
}
