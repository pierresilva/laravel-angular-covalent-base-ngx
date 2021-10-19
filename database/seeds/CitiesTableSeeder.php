<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CitiesTableSeeder extends Seeder
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

            DB::table('cities')->insert([
                'name' => $faker->city,
                'code' => $faker->numerify("city_####"),
                'region_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
