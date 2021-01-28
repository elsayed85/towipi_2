<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product\Character;
use Faker\Generator as Faker;

$factory->define(Character::class, function (Faker $faker) {
    return [
        "en" => [
            'name' => $faker->firstName()
        ]
    ];
});
