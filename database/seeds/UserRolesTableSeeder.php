<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserRolesTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $faker = Faker\Factory::create();

        for($i=0;$i<30;$i++){

            DB::table('user_roles')->insert([
                'name' => $faker->words(3, true),
                'code' => $faker->words(3, true),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
