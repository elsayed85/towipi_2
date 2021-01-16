<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\General\Page;
use Faker\Generator as Faker;

$factory->define(Page::class, function (Faker $faker) {
    return [
        "slug" => $faker->slug(3),
        "en" => [
            'title' => $faker->sentence(),
            'body' => $faker->randomHtml()
        ],
    ];
});
