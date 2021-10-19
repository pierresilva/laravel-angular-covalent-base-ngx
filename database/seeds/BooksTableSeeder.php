<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class BooksTableSeeder extends Seeder
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

            DB::table('books')->insert([
                'title' => $faker->words(3, true),
                'code' => $faker->words(3, true),
                'genre_id' => $faker->numberBetween(1,30),
                'cover' => $faker->imageUrl(640, 480),
                'published_at' => $faker->date("Y-m-d", "now"),
                'edition' => $faker->randomDigit,
                'bought_at' => $faker->dateTimeBetween(" - 30 years", "now", "America/Bogota"),
                'resume' => $faker->paragraph(3, true),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
