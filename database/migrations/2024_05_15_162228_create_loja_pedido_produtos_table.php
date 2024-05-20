<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLojaPedidoProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loja_pedido_produtos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('status', ['RE', 'PA', 'CA'])->comment(' Reservado, Pago, Cancelado'); // Reservado, Pago, Cancelado
            $table->decimal('valor', 6, 2)->default(0);
            $table->decimal('desconto', 6, 2)->default(0);
            $table->integer('quantidade')->nullable(false);
            $table->unsignedBigInteger('produto_id');
            $table->foreign('produto_id')
                ->references('id')
                ->on('loja_produtos_variacao')
                ->onDelete('cascade');

            $table->unsignedBigInteger('pedido_id');
            $table->foreign('pedido_id')
                ->references('id')
                ->on('loja_pedidos')
                ->onDelete('cascade');

            $table->unsignedBigInteger('cupom_desconto_id')->nullable();
            $table->foreign('cupom_desconto_id')
                ->references('id')
                ->on('loja_cupom_descontos')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loja_pedido_produtos');
    }
}
