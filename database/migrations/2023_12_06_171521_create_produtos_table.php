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
            $table->increments('id');
            $table->string('nome');
            $table->string('codigo_barras')->nullable();
            $table->string('preco');
            $table->string('preco_custo');
            $table->string('lucro');
            $table->integer('estoque');
            $table->string('fornecedor')->nullable();
            $table->string('categoria')->nullable();
            $table->timestamp('created_at', 0)->nullable();
            $table->timestamp('updated_at', 0)->nullable();
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
