<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->decimal('subtotal', 10, 2)->default(0)->after('usuario_id');
            $table->decimal('descuento', 10, 2)->default(0)->after('total');
            $table->decimal('recargo', 10, 2)->default(0)->after('descuento');
            $table->integer('cuotas')->nullable()->after('metodo_pago');
        });
    }

    public function down(): void
    {
        Schema::table('pedidos', function (Blueprint $table) {
            $table->dropColumn(['subtotal', 'descuento', 'recargo', 'cuotas']);
        });
    }
};
