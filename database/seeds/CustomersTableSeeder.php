<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class CustomersTableSeeder extends Seeder
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

            DB::table('customers')->insert([
                'name' => $faker->company,
                'first_name' => $faker->firstNameMale,
                'first_surname' => $faker->lastName,
                'person_type' => $faker->randomElement(["natural","juridica"]),
                'document_type' => $faker->randomElement(["CC","TI","CE","NIT"]),
                'document_number' => $faker->numberBetween(1000000, 9000000),
                'address' => $faker->address,
                'phone' => $faker->phoneNumber,
                'email' => $faker->safeEmail,
                'contact_name' => $faker->name(),
                'until_date' => $faker->date("Y-m-d", "2023-06-30"),
                'credit' => $faker->numberBetween(1000000, 9000000),
                'credit_current' => $faker->numberBetween(1000000, 9000000),
                'user_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
