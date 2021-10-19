<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class FilesTableSeeder extends Seeder

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

            DB::table('files')->insert([

                'name' => $faker->words(3, true),
                'file' => $faker->words(3, true),
                'extension' => $faker->fileExtension,
                'mime' => $faker->mimeType,
                'url' => $faker->imageUrl(480, 320, 'cats'),
                'fileable_id' => $faker->numberBetween(1, 30),
                'fileable_type' => $faker->randomElement(['\App\Models\CounMeetingCitation', '\App\Models\CounMeeting']),
            ]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
