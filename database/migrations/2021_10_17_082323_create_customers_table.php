<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('customers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name')->comment('Nombre del cliente');
            $table->string('first_name')->nullable()->comment('Primer nombre del cliente');
            $table->string('first_surname')->nullable()->comment('Primer apellido del cliente');
            $table->string('person_type')->comment('Tipo de persona del cliente');
            $table->string('document_type')->comment('Tipo de documento del cliente');
            $table->string('document_number')->comment('Número de documento del cliente');
            $table->string('address')->nullable()->comment('Dirección del cliente');
            $table->string('phone')->nullable()->comment('Teléfono del cliente');
            $table->string('email')->nullable()->comment('Correo electrónico del cliente');
            $table->string('contact_name')->nullable()->comment('Nombre del contacto del cliente');
            $table->date('until_date')->nullable()->comment('Fecha de finalización del contrato del cliente');
            $table->integer('credit')->nullable()->comment('Crédito asignado al cliente');
            $table->integer('credit_current')->nullable()->comment('Crédito acumulado del cliente');
            $table->unsignedBigInteger('user_id')->nullable()->comment('');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('customers');
        Schema::enableForeignKeyConstraints();
    }
}
