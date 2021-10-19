<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ServiceOrderFilesTableSeeder extends Seeder
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

            DB::table('service_order_files')->insert([
                'name' => $faker->words(3, true),
                'file' => $faker->imageUrl(640, 480),
                'service_order_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
