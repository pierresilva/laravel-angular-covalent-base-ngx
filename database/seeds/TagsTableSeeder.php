<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TagsTableSeeder extends Seeder
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

            DB::table('tags')->insert([
                'name' => $faker->words(3, true),
                'code' => $faker->words(3, true),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
