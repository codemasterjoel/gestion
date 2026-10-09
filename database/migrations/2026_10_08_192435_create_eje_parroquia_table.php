<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('eje_parroquia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('eje_id')->constrained('ejes')->cascadeOnDelete()->nullableOnUpdate();
            $table->foreignId('parroquia_id')->constrained('parroquias')->cascadeOnDelete()->nullableOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('eje_parroquia');
    }
};
