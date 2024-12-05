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
        Schema::create('hikings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('mountains_id');
            $table->unsignedBigInteger('hiking_routes_id');
            $table->date('start_date')->default(date('Y-m-d'));
            $table->date('end_date')->default(date('Y-m-d'));
            $table->integer('companions')->default(1);
            $table->string('notes', 255)->nullable();
            $table->enum('hikings_status', [
                'Active',
                'Scheduled',
                'Completed',
                'Cancelled',
            ])->default('Scheduled');
            $table->time('duration')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('mountains_id')->references('id')->on('mountains');
            $table->foreign('hiking_routes_id')->references('id')->on('hiking_routes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hikings');
    }
};
