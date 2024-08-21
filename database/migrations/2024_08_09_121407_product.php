<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id("product_id");
            $table->string('codigo');
            $table->string('nombre');
            $table->string('expiracion'); 
            $table->integer('stock_inicial');
            $table->integer('entrada');
            $table->integer('salida');
            $table->integer('existencia');
            $table->timestamps();
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};
