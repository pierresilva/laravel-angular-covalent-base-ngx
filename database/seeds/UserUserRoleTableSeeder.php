<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserUserRoleTableSeeder extends Seeder

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

            DB::table('user_user_role')->insert([

                'user_id' => $faker->numberBetween(1,30),
                'user_role_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
