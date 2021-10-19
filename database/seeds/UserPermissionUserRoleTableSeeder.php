<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserPermissionUserRoleTableSeeder extends Seeder

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

            DB::table('user_permission_user_role')->insert([

                'user_permission_id' => $faker->numberBetween(1,30),
                'user_role_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
