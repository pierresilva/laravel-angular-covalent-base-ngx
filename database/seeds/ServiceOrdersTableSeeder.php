<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ServiceOrdersTableSeeder extends Seeder
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

            DB::table('service_orders')->insert([
                'name' => $faker->words(3, true),
                'customer_id' => $faker->numberBetween(1,30),
                'patient_id' => $faker->numberBetween(1,30),
                'examination_type_id' => $faker->numberBetween(1,30),
                'date_attention' => $faker->dateTime("now", "America/Bogota"),
                'supplier_id' => $faker->numberBetween(1,30),
                'city_id' => $faker->numberBetween(1,30),
                'status' => $faker->randomElement(["activo","inactivo","solicitada","asignada","aceptada","procesada","validada","pendiente","cancelada"]),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
