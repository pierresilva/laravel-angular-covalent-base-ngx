<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('supplier_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name')->comment('Nombre de la tarifa del proveedor');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('Identificador del proveedor');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('examination_test_id')->nullable()->comment('Identificador del análisis');
            $table->foreign('examination_test_id')->references('id')->on('examination_tests')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('price')->comment('Precio de la tarifa del análisis');
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
        Schema::dropIfExists('supplier_rates');
        Schema::enableForeignKeyConstraints();
    }
}
