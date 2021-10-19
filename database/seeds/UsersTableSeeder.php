<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class UsersTableSeeder extends Seeder
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

            DB::table('users')->insert([
                'name' => $faker->name(),
                'email' => $faker->safeEmail,
                'password' => bcrypt('password'),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
