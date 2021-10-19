<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfilesTable extends Migration

{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('name')->comment('');
            $table->unsignedBigInteger('user_id')->nullable()->comment('');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('syst_city_id')->nullable()->comment('');
            $table->foreign('syst_city_id')->references('id')->on('syst_cities')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('syst_region_id')->nullable()->comment('');
            $table->foreign('syst_region_id')->references('id')->on('syst_regions')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('syst_country_id')->nullable()->comment('');
            $table->foreign('syst_country_id')->references('id')->on('syst_countries')->onUpdate('cascade')->onDelete('cascade');
            $table->string('address')->nullable()->comment('');
            $table->string('phone')->nullable()->comment('');
            $table->string('avatar')->nullable()->comment('');
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
        Schema::dropIfExists('user_profiles');
        Schema::enableForeignKeyConstraints();
    }
}
