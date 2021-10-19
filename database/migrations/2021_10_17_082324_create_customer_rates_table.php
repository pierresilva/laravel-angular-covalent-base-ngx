<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomerRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('customer_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name')->comment('Nombre de la tarifa');
            $table->unsignedBigInteger('customer_id')->comment('Cliente');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('examination_test_id')->comment('Identificador de la prueba');
            $table->foreign('examination_test_id')->references('id')->on('examination_tests')->onUpdate('cascade')->onDelete('cascade');
            $table->float('price')->comment('Precio de la prueba para el cliente');
            $table->softDeletes();
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('customer_rates');
        Schema::enableForeignKeyConstraints();
    }
}
