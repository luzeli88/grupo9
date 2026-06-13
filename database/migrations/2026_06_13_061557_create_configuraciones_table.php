<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('configuraciones', function (Blueprint $table) {
        $table->string('clave')->primary();
        $table->string('valor');
        $table->string('descripcion')->nullable();
        $table->timestamps();
    });

    DB::table('configuraciones')->insert([
        ['clave' => 'descuento_transferencia', 'valor' => '10', 'descripcion' => 'Descuento por transferencia (%)', 'created_at' => now(), 'updated_at' => now()],
        ['clave' => 'recargo_credito_6',       'valor' => '0',  'descripcion' => 'Recargo crédito hasta 6 cuotas (%)', 'created_at' => now(), 'updated_at' => now()],
        ['clave' => 'recargo_credito_mas6',    'valor' => '15', 'descripcion' => 'Recargo crédito más de 6 cuotas (%)', 'created_at' => now(), 'updated_at' => now()],
    ]);
}
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuraciones');
    }
};
