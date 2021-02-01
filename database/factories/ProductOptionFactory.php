<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product\Option;
use App\Models\Product\ProductOption;
use Faker\Generator as Faker;

$factory->define(Option::class, function (Faker $faker) {
    return [
        "en" => [
            'name' => $faker->firstName()
        ]
    ];
});
