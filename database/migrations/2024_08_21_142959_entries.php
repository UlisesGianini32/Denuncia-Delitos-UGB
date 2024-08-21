<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->id('entry_id');
            $table->string('rep');
            $table->string('producto');
            $table->integer('cantidad');
            $table->string('foto');
            $table->string('firma');
            $table->timestamps(); // created_at y updated_at
        });
    }    

    public function down(): void
    {
        //
    }
};
