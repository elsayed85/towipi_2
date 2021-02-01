<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Product\Category;
use App\Models\Product\Character;
use App\Models\Product\Option;
use App\Models\Product\OptionValue;
use App\Models\Product\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        "video_url" => $faker->url,
        'category_id' => Category::all()->random()->id,
        'price' => rand(100, 5000),
        'en' => [
            'title' => $faker->sentence(),
            'description' => $faker->paragraph(3)
        ]
    ];
});

$options = [
    ['en' => [
        'name' => 'color'
    ]],
    ['en' => [
        'name' => 'size'
    ]]
];

$factory->afterCreating(
    Product::class,
    function (Product $product, Faker $faker) use ($options) {
        $product->setStock(rand(1, 10));
        $product->options()->saveMany(
            collect($options)
                ->take(rand(1, 2))
                ->map(function ($el) {
                    return (new Option($el));
                })
        );
        $product->options->each(function (Option $op) {
            if ($op->name == "color") {
                $op->values()->saveMany(
                    collect([
                        ['en' => ['value' => 'green']],
                        ['en' => ['value' => 'red']],
                        ['en' => ['value' => 'blue']]
                    ])
                        ->take(rand(1, 3))
                        ->map(function ($el) {
                            return (new OptionValue($el));
                        })
                );
            } elseif ($op->name == "size") {
                $op->values()->saveMany(
                    collect([
                        ['en' => ['value' => 'large']],
                        ['en' => ['value' => 'x-large']],
                        ['en' => ['value' => 'small']]
                    ])
                        ->take(rand(1, 3))
                        ->map(function ($el) {
                            return (new OptionValue($el));
                        })
                );
            }
        });
    }
);
