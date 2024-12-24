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
        // $table->id();
        // $table->unsignedBigInteger('user_id');
        // $table->unsignedBigInteger('hikingroute_id');
        // $table->date('start_date')->default(date('Y-m-d'));
        // $table->date('end_date')->default(date('Y-m-d'));
        // $table->integer('numb_of_teams')->default(1);
        // $table->string('notes', 255)->nullable();
        // $table->enum('status', [
        //     'Active',
        //     'Scheduled',
        //     'Completed',
        //     'Cancelled',
        // ])->default('Scheduled');
        // $table->time('duration')->nullable();
        // $table->timestamps();
        // $table->softDeletes();

        Hiking::create([
            'user_id' => 2,
            'hiking_route_id' => 1,
            'start_date' => '2023-10-10',
            'end_date' => '2023-10-10',
            'numb_of_teams' => 1,
            'notes' => 'lorem ipsum',
            'status' => 'Active',
            'duration' => '00:00:00',
        ]);

        // Hiking::create([
        //     'user_id' => 2,
        //     'hiking_route_id' => 2,
        //     'start_date' => '2023-10-10',
        //     'end_date' => '2023-10-10',
        //     'numb_of_teams' => 1,
        //     'notes' => 'lorem ipsum',
        //     'status' => 'Active',
        //     'duration' => '00:00:00',
        // ]);
    }
}
