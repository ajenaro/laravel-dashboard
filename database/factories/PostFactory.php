<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Post;
use App\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {

    $title = $faker->sentence(3, true);
    return [
        'category_id' => rand(1 , Category::count()),
        'user_id' => rand(1 , User::count()),
        'title' => substr($title, 0, -1),
        'url'   => Str::slug($title, '-'),
        'excerpt' => $faker->paragraph(2, true),
        'body'  => '<p>' . $faker->text(800) . '</p>',
        'published_at' => Carbon::now()->subDays(rand(1, 20))->format('d/m/Y')
    ];
});
