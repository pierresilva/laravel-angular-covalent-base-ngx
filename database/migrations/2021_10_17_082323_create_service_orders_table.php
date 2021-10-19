<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('service_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name')->comment('Nombre de la orden de servicio');
            $table->unsignedBigInteger('customer_id')->nullable()->comment('Identificador del cliente');
            $table->foreign('customer_id')->references('id')->on('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('patient_id')->nullable()->comment('identificador del paciente');
            $table->foreign('patient_id')->references('id')->on('patients')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('examination_type_id')->nullable()->comment('Identificador del tipo de examen');
            $table->foreign('examination_type_id')->references('id')->on('examination_types')->onUpdate('cascade')->onDelete('cascade');
            $table->datetime('date_attention')->comment('Fecha aproximada de atención');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('Identificador del proveedor');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('city_id')->nullable()->comment('Identificador de la ciudad');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->string('status')->nullable()->comment('Estado de la orden');
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
        Schema::dropIfExists('service_orders');
        Schema::enableForeignKeyConstraints();
    }
}
