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
        Schema::create('lots', function (Blueprint $table) {
            $table->id('lot_id');
            $table->string('codigo');
            $table->string('rpe');
            $table->string('producto');
            $table->integer('cantidad');
            $table->string('producto_2');
            $table->integer('cantidad_2');
            $table->string('producto_3');
            $table->integer('cantidad_3');
            $table->string('producto_4');
            $table->integer('cantidad_4');
            $table->string('imagen');
            $table->string('firma');
            $table->string('rpe2');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lot');
    }
};
