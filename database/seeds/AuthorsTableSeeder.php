<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class AuthorsTableSeeder extends Seeder
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

            DB::table('authors')->insert([
                'name' => $faker->name(),
                'code' => $faker->words(3, true),
                'gender' => $faker->randomElement(["male","female"]),
                'birth_date' => $faker->date("Y-m-d", "now"),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
