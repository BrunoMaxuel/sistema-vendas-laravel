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
            $table->string('cliente')->default('Visitante');
            $table->integer('desconto')->default(1);
            $table->integer('parcela');
            $table->decimal('valor_parcela')->default(0.00);
            $table->decimal('venda_com_desconto')->default(0.00);
            $table->decimal('total')->default(0.00);
            $table->integer('total_item');
            $table->enum('pagamento',['Dinheiro','Crédito','Débito']);

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
