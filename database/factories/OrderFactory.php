<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Model;

$factory->define(\App\Models\Order::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(4),
    ];
});
