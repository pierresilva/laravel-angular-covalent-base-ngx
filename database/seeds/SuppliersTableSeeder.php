<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SuppliersTableSeeder extends Seeder
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

            DB::table('suppliers')->insert([
                'name' => $faker->company,
                'person_type' => $faker->randomElement(["natural","juridica"]),
                'document_type' => $faker->randomElement(["CC","CE","NIT"]),
                'document_number' => $faker->numberBetween(1000000, 9000000),
                'user_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
