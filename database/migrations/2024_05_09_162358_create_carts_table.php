<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loja_carts', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('produto_id');
            $table->unsignedBigInteger('variacao_id');
            $table->unsignedBigInteger('cliente_id');
            $table->string('descricao');
            $table->Integer('quantidade');
            $table->decimal('valor', 8, 2);

            $table->foreign('cliente_id')->references('id')->on('loja_clientes');
            $table->foreign('produto_id')->references('id')->on('loja_produtos_new');
            $table->foreign('variacao_id')->references('id')->on('loja_produtos_variacao');

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
        Schema::dropIfExists('loja_carts');
    }
}
