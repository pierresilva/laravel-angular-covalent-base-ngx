<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PositionsTableSeeder extends Seeder
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

            DB::table('positions')->insert([
                'name' => $faker->words(3, true),
                'notify_on_create_service_order' => $faker->boolean(50),
                'notify_on_assign_service_order' => $faker->boolean(50),
                'notify_on_reject_service_order' => $faker->boolean(50),
                'notify_on_accept_service_order' => $faker->boolean(50),
                'notify_on_complete_service_order' => $faker->boolean(50),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
