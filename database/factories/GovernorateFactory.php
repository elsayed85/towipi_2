<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\General\Governorate;
use Faker\Generator as Faker;

$factory->define(Governorate::class, function (Faker $faker) {
    return [
        "name" => $faker->firstName,
        'shipping_price' => $faker->randomFloat()
    ];
});
