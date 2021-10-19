<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSupplierHeadquartersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('supplier_headquarters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name')->comment('Nombre de la sede');
            $table->unsignedBigInteger('supplier_id')->nullable()->comment('');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('city_id')->nullable()->comment('Identificador de la ciudad de la sede');
            $table->foreign('city_id')->references('id')->on('cities')->onUpdate('cascade')->onDelete('cascade');
            $table->string('phone')->nullable()->comment('Número de teléfono de la sede');
            $table->string('address')->nullable()->comment('Dirección de la sede');
            $table->string('email')->nullable()->comment('');
            $table->string('contact_name')->nullable()->comment('Nombre del contacto de la sede');
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
        Schema::dropIfExists('supplier_headquarters');
        Schema::enableForeignKeyConstraints();
    }
}
