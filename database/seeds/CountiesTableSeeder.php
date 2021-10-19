<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CountiesTableSeeder extends Seeder
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

            DB::table('counties')->insert([
                'name' => $faker->country,
                'code' => $faker->countryCode,
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
