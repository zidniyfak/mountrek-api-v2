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
            $table->unsignedBigInteger('mountain_id');
            $table->string('name');
            $table->enum('status', ['Buka', 'Tutup'])->default('Buka');
            $table->enum('difficulty', ['Mudah', 'Normal', 'Sulit'])->default('Mudah');
            $table->string('location');
            $table->decimal('distance')->nullable();
            $table->decimal('duration', 5, 2)->nullable();
            $table->string('operating_hours')->default('24 Jam');
            $table->integer('numb_of_posts');
            $table->string('contact', 15)->nullable();
            $table->integer('fee')->nullable();
            $table->double('lat')->nullable();
            $table->double('lng')->nullable();
            $table->string('img')->nullable();
            $table->string('file')->nullable();
            $table->text('rules')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('mountain_id')->references('id')->on('mountains');
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
