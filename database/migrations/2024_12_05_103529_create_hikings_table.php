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
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('hiking_route_id');
            $table->date('start_date')->default(date('Y-m-d'));
            $table->date('end_date')->default(date('Y-m-d'));
            $table->integer('numb_of_teams')->default(1);
            $table->string('notes', 255)->nullable();
            $table->enum('status', [
                'Active',
                'Scheduled',
                'Completed',
                'Cancelled',
            ])->default('Scheduled');
            $table->time('duration')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('hiking_route_id')->references('id')->on('hiking_routes');
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
