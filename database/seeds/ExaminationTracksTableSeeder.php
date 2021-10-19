<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ExaminationTracksTableSeeder extends Seeder
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

            DB::table('examination_tracks')->insert([
                'name' => $faker->words(4, true),
                'description' => $faker->paragraph(3, true),
                'user_id' => $faker->numberBetween(1,30),
                'service_order_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
