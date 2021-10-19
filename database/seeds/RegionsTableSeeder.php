<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RegionsTableSeeder extends Seeder
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

            DB::table('regions')->insert([
                'name' => $faker->city,
                'code' => $faker->numerify("region_####"),
                'county_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
