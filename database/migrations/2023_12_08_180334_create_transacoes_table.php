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
            $table->string('cliente');
            $table->integer('desconto');
            $table->enum('pagamento',['DI','CR','DE']);
            $table->integer('parcelas');
            $table->string('valor_parcelas');
            $table->string('total');
            $table->timestamps();


            $table->unsignedBigInteger('cliente_foreign');
            $table->foreign('cliente_foreign')->references('id')->on('clientes')->onUpdate('cascade');

            

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
