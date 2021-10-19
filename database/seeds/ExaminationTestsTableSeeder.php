<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ExaminationTestsTableSeeder extends Seeder
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

            DB::table('examination_tests')->insert([
                'name' => $faker->words(3, true),
                'description' => $faker->paragraph(3, true),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
