<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla polimórfica para imágenes
        Schema::create('imagenes', function (Blueprint $table) {
            $table->id();
            $table->morphs('imageable'); // Crea imageable_id, imageable_type e índice automáticamente
            $table->string('url');
            $table->string('nombre')->nullable();
            $table->integer('orden')->default(0);
            $table->timestamps();
            
            // morphs() ya crea el índice compuesto, solo agregamos el de orden
            $table->index('orden');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};
