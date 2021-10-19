<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('setting_group_id')->nullable();
            $table->foreign('setting_group_id')
                ->references('id')
                ->on('setting_groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('code')->nullable();
            $table->longText('value');
            $table->boolean('rich_text')->nullable();
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
        Schema::dropIfExists('settings');
        Schema::disableForeignKeyConstraints();
    }
}
