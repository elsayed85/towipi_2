<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Site\Faq;
use Faker\Generator as Faker;

$factory->define(Faq::class, function (Faker $faker) {
    return [
        "en" => [
            'title' => $faker->sentence(),
            'body' => $faker->paragraph(3)
        ],
        "ar" => [
            'title' => "العنوان هنا",
            'body' => "وصف السؤال"
        ]
    ];
});
