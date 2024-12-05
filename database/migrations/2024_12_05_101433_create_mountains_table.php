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
            $table->string('mountains_name', 50);
            $table->string('region', 50);
            $table->integer('altitude')->default(0);
            $table->enum('mountains_status', ['Aktif', 'Tidak Aktif'])->default('Tidak Aktif');
            $table->string('mountains_type', 50)->default("-");
            $table->decimal('latitude', 20, 15)->default(0.0);
            $table->decimal('longitude', 20, 15)->default(0.0);
            $table->text('description')->nullable();
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
