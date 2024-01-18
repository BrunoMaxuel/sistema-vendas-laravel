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
        Schema::create('produtos', function (Blueprint $table) {
                $table->id('id');
                $table->string('nome');
                $table->string('codigo_barras')->nullable();
                $table->decimal('preco');
                $table->decimal('preco_custo');
                $table->string('lucro');
                $table->integer('estoque');
                $table->string('fornecedor')->nullable();
                $table->string('categoria')->nullable();

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
        Schema::dropIfExists('estoques');
    }
};
