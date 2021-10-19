<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alter2RemoveColumnToAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('authors', function (Blueprint $table) {
            \App\Helpers\DataBaseHelpers::dropForeignKey('authors', 'gender');
            $table->dropColumn('gender');
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
        Schema::table('authors', function (Blueprint $table) {
            $table->string('gender')->nullable();
        });
        Schema::enableForeignKeyConstraints();
    }
}
