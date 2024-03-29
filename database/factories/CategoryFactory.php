<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->sentence(2, true);
    return [
        'name' => $title,
        'url'   => Str::slug($title, '-'),
    ];
});
