<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExaminationTestServiceOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('examination_test_service_order', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('examination_test_id')->nullable()->comment('');
            $table->foreign('examination_test_id')->references('id')->on('examination_tests')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('service_order_id')->nullable()->comment('');
            $table->foreign('service_order_id')->references('id')->on('service_orders')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('examination_test_service_order');
        Schema::enableForeignKeyConstraints();
    }
}
