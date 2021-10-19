<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BookTagTableSeeder extends Seeder
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

            DB::table('book_tag')->insert([
                'book_id' => $faker->numberBetween(1,30),
                'tag_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
