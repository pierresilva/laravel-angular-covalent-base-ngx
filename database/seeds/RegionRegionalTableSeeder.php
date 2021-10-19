<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class RegionRegionalTableSeeder extends Seeder
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

            DB::table('region_regional')->insert([
                'region_id' => $faker->numberBetween(1,30),
                'regional_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
