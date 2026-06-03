<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('carrito', function (Blueprint $table) {
            $table->integer('talle')->nullable()->after('producto_id');
        });
    }

    public function down(): void
    {
        Schema::table('carrito', function (Blueprint $table) {
            $table->dropColumn('talle');
        });
    }
};
