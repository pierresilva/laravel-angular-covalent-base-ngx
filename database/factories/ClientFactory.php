<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Model;

$factory->define(\App\Client::class, function (Faker $faker) {
    $name = $faker->company;
    return [
        'name' => $name,
        'database_name' => \Illuminate\Support\Str::snake(\Illuminate\Support\Str::slug($name)),
        'database_host' => 'localhost',
        'database_username' => 'root',
        'database_password' => 'colombia#1',
        'database_port' => '3360'
    ];
});
