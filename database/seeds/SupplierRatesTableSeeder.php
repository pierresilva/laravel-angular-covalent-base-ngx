<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SupplierRatesTableSeeder extends Seeder
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

            DB::table('supplier_rates')->insert([
                'name' => $faker->words(5, true),
                'supplier_id' => $faker->numberBetween(1,30),
                'examination_test_id' => $faker->numberBetween(1,30),
                'price' => $faker->numberBetween(10000, 90000),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
