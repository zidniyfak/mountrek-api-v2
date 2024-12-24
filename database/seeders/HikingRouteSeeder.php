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
        // $table->unsignedBigInteger('mountain_id');
        // $table->string('name');
        // $table->enum('status', ['Buka', 'Tutup'])->default('Buka');
        // $table->enum('difficulty', ['Mudah', 'Normal', 'Sulit'])->default('Mudah');
        // $table->string('location');
        // $table->decimal('distance')->nullable();
        // $table->decimal('duration', 5, 2)->nullable();
        // $table->integer('elevation_gain')->nullable();
        // $table->string('operating_hours', 100)->default('24 Jam');
        // $table->integer('numb_of_posts');
        // $table->string('contact', 100)->nullable()->default('text');
        // $table->integer('fee')->nullable();
        // $table->string('img')->nullable();
        // $table->string('file')->nullable();
        // $table->string('link')->nullable();
        // $table->text('rules')->nullable();
        // $table->timestamps();
        // $table->softDeletes();

        HikingRoute::create([
            'mountain_id' => 1,
            'name' => 'Sawit',
            'status' => 'Buka',
            'difficulty' => 'Mudah',
            'location' => 'Kab. Magelang',
            'distance' => 1,
            'duration' => 1,
            'elevation_gain' => 1,
            'operating_hours' => '24 Jam',
            'numb_of_posts' => 3,
            'contact' => '098765431234',
            'fee' => 25000,
        ]);
    }
}
