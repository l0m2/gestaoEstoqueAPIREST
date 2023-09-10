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
        Schema::create('itens_pedido_compras', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pedido_compra_id');
            $table->foreign('pedido_compra_id')->references('id')->on('pedido_compras')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')->references('id')->on('produtos')->onDelete('cascade')->onUpdate('cascade');
            $table->integer('quantidade');
            $table->decimal('preco_unitario', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itens_pedido_compras');
    }
};
