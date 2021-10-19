<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailsTable extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('mails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->unsignedBigInteger('mail_template_id')->nullable()->comment('');
            $table->foreign('mail_template_id')->references('id')->on('mail_templates')->onUpdate('cascade')->onDelete('cascade');
            $table->string('subject')->comment('');
            $table->string('receiver')->comment('');
            $table->longText('html')->nullable()->comment('');
            $table->longText('text')->nullable()->comment('');
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
        Schema::dropIfExists('mails');
        Schema::enableForeignKeyConstraints();
    }
}
