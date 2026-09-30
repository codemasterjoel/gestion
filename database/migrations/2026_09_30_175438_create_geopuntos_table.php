<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('geopuntos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->nullable();
            $table->string('direccion')->nullable();
            $table->text('descripcion')->nullable();

            $table->text('latitud')->nullable();
            $table->text('longitud')->nullable();

            $table->foreignId('eje_id')->nullable()->references('id')->on('ejes')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('parroquia_id')->nullable()->references('id')->on('parroquias')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('comuna_id')->nullable()->references('id')->on('comunas')->nullOnDelete()->cascadeOnUpdate();
            $table->foreignId('categoria_id')->nullable()->references('id')->on('categorias')->nullOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('geopuntos');
    }
};
