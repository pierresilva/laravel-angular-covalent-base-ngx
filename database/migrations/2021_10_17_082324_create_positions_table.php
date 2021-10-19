<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('positions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name')->comment('Nombre del cargo');
            $table->boolean('notify_on_create_service_order')->nullable()->comment('Determina si se envia un email al cuando un cliente crea una orden de servicio');
            $table->boolean('notify_on_assign_service_order')->nullable()->comment('Determina si se notifica cuando se asigna una orden de servicio');
            $table->boolean('notify_on_reject_service_order')->nullable()->comment('Determina si se envia una notificacion cuando un proveedor rechaza una orden de servicio');
            $table->boolean('notify_on_accept_service_order')->nullable()->comment('Determina si se notifica cuando un proveedor acepte la orden de servicio');
            $table->boolean('notify_on_complete_service_order')->nullable()->comment('Determina si se notifica cuando el proveedor complete la orden de servicio');
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
        Schema::dropIfExists('positions');
        Schema::enableForeignKeyConstraints();
    }
}
