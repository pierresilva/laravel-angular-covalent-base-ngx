<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class PatientsTableSeeder extends Seeder
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

            DB::table('patients')->insert([
                'first_name' => $faker->firstNameMale,
                'second_name' => $faker->firstNameMale,
                'first_surname' => $faker->lastName,
                'second_surname' => $faker->lastName,
                'full_name' => $faker->name(),
                'email' => '',
                'phone' => $faker->phoneNumber,
                'whatsapp' => $faker->phoneNumber,
                'document_type' => $faker->randomElement(["CC","TI","CE"]),
                'document_number' => $faker->numberBetween(1000000, 9000000),
                'user_id' => $faker->numberBetween(1,30),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
