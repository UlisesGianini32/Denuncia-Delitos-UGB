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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id(); // Utiliza este método para hacer el campo 'id' autoincremental
            $table->integer('complaint_id')->autoIncrement(); // Añade el método autoIncrement para hacer el campo autoincremental
            $table->string('description');
            $table->string('complaint_status');
            $table->integer('victim_id')->autoIncrement(); // Añade el método autoIncrement para hacer el campo autoincremental
            $table->integer('witness_id')->autoIncrement(); // Añade el método autoIncrement para hacer el campo autoincremental
            $table->integer('suspect_id')->autoIncrement(); // Añade el método autoIncrement para hacer el campo autoincremental
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
