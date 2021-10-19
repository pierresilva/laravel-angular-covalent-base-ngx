<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UserProfilesTableSeeder extends Seeder

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

            DB::table('user_profiles')->insert([

                'name' => $faker->name,
                'user_id' => $faker->numberBetween(1,30),
                'syst_city_id' => $faker->numberBetween(1,30),
                'syst_region_id' => $faker->numberBetween(1,30),
                'syst_country_id' => $faker->numberBetween(1,30),
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'avatar' => $faker->imageUrl(320, 320, 'cats'),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
