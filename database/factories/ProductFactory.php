<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product\Category;
use App\Models\Product\Character;
use App\Models\Product\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "video_url" => $faker->url,
        'category_id' => Category::all()->random()->id,
        'en' => [
            'title' => $faker->sentence(),
            'description' => $faker->paragraph(3)
        ]
    ];
});


$factory->afterCreating(Product::class, function (Product $product, Faker $faker) {
    $product->setStock(rand(1, 10));
    $product->characters()->attach(Character::all()->random(rand(4, 10)));
});
