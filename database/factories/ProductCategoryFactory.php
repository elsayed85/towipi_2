<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        "en" => [
            'name' => $faker->word()
        ],
        'parent_id' => Category::all()->random()->id
    ];
});
