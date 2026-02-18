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
            $table->morphs('imageable'); // Crea imageable_id e imageable_type
            $table->string('url');
            $table->string('nombre')->nullable();
            $table->integer('orden')->default(0);
            $table->timestamps();
            
            $table->index(['imageable_type', 'imageable_id']);
            $table->index('orden');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('imagenes');
    }
};
