<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transacoes', function (Blueprint $table) {
            $table->id();
            $table->string('cliente')->default('Não identificado');
            $table->integer('desconto');
            $table->integer('parcelas');
            $table->string('valor_parcelas');
            $table->string('venda_item');
            $table->integer('total');
            $table->enum('pagamento',['DI','CR','DE']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transacoes');
    }
};
