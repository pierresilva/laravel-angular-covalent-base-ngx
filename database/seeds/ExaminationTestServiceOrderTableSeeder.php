<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ExaminationTestServiceOrderTableSeeder extends Seeder
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

            DB::table('examination_test_service_order')->insert([
                'examination_test_id' => $faker->numberBetween(1,30),
                'service_order_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
