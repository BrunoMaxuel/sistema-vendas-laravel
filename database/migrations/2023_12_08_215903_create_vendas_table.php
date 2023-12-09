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
        Schema::create('vendas', function (Blueprint $table) {
            $table->id();
            $table->integer('quantidade');
            $table->string('valor_venda');
            $table->timestamps();
            
            
            $table->unsignedBigInteger('transacao');
            $table->unsignedBigInteger('produto_transacao');
            $table->foreign('transacao')->references('id')->on('transacoes');
            $table->foreign('produto_transacao')->references('id')->on('produtos');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas');
    }
};
