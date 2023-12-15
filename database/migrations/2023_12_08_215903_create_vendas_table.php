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
            $table->string('nome_produto');
            $table->string('codigo_barras')->nullable();
            $table->integer('quantidade');
            $table->decimal('valor_item');
            $table->decimal('total_venda');
            $table->boolean('item_cancelado')->default(false);
            $table->boolean('venda_finalizada')->default(false);
            $table->timestamps();
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
