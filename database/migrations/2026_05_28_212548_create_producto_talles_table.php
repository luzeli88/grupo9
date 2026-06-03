<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('producto_talles', function (Blueprint $table) {
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            $table->integer('talle');
            $table->integer('stock')->default(0);
            $table->unique(['producto_id', 'talle']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto_talles');
    }
};