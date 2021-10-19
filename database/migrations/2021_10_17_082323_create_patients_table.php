<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('patients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('first_name')->comment('Nombre del paciente');
            $table->string('second_name')->nullable()->comment('');
            $table->string('first_surname')->comment('Primer apellido del paciente');
            $table->string('second_surname')->nullable()->comment('Segundo apellido del paciente');
            $table->string('full_name')->nullable()->comment('Nombre completo del paciente');
            $table->string('email')->nullable()->comment('');
            $table->string('phone')->nullable()->comment('Teléfono del paciente');
            $table->string('whatsapp')->nullable()->comment('Número de Whatsapp del paciente');
            $table->string('document_type')->comment('Tipo de documento');
            $table->string('document_number')->comment('');
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
        Schema::dropIfExists('patients');
        Schema::enableForeignKeyConstraints();
    }
}
