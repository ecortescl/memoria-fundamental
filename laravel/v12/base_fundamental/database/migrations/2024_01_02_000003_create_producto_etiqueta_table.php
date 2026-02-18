<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Tabla pivot con modelo personalizado
        Schema::create('producto_etiqueta', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->foreignId('etiqueta_id')->constrained('etiquetas')->onDelete('cascade');
            $table->integer('orden')->default(0);
            $table->text('notas')->nullable();
            $table->timestamps();
            
            $table->unique(['producto_id', 'etiqueta_id']);
            $table->index('orden');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto_etiqueta');
    }
};
