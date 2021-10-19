<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class SupplierHeadquartersTableSeeder extends Seeder
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

            DB::table('supplier_headquarters')->insert([
                'name' => $faker->words(3, true),
                'supplier_id' => $faker->numberBetween(1,30),
                'city_id' => $faker->numberBetween(1,30),
                'phone' => $faker->phoneNumber,
                'address' => $faker->address,
                'email' => '',
                'contact_name' => $faker->name("male"),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
