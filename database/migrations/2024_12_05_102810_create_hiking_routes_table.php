<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hiking_routes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mountains_id');
            $table->string('routes_name');
            $table->enum('status', ['Buka', 'Tutup'])->default('Buka');
            $table->enum('difficulty', ['Mudah', 'Normal', 'Sulit'])->default('Mudah');
            $table->decimal('distance')->nullable();
            $table->decimal('duration', 5, 2)->nullable();
            $table->integer('elevation_gain')->nullable();
            $table->integer('number_of_pos');
            $table->string('location');
            $table->string('img')->nullable();
            $table->string('file')->nullable();
            $table->string('links')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('mountains_id')->references('id')->on('mountains');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hiking_routes');
    }
};
