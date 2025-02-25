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
        Schema::create('mountains', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('location');
            $table->integer('altitude')->default(0);
            $table->enum('status', ['Aktif', 'Tidak Aktif'])->default('Tidak Aktif');
            $table->enum('type', ['Maar', 'Strato', 'Perisai', 'Lainnya'])->default('Maar');
            $table->decimal('lat', 20, 15)->default(0.0);
            $table->decimal('lng', 20, 15)->default(0.0);
            $table->text('desc')->nullable();
            $table->string('img')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mountains');
    }
};
