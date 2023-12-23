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
        Schema::create('vendas_detalhada', function (Blueprint $table) {
            $table->id();
            $table->string('nome_produto');
            $table->string('codigo_barras')->nullable();
            $table->integer('quantidade');
            $table->decimal('valor_item')->default(0.00);
            $table->decimal('total_venda')->default(0.00);
            $table->boolean('item_cancelado')->default(false);
            $table->boolean('venda_finalizada')->default(false);



            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');            
            $table->unsignedBigInteger('id_transacao');
            $table->foreign('id_transacao')->references('id')->on('transacoes')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendas_detalhada');
    }
};
