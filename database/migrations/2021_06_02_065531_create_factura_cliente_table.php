<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacturaClienteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factura_cliente', function (Blueprint $table) {
            $table->unsignedBigInteger('id_factura')->nullable();
            $table->unsignedBigInteger('id_cliente')->nullable();

            $table->foreign('id_factura')->references('id')->on('facturas')
                ->cascadeOnDelete();
            $table->foreign('id_cliente')->references('id')->on('clientes')
                ->cascadeOnDelete();

            $table->primary(['id_factura', 'id_cliente']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('factura_cliente');
    }
}
