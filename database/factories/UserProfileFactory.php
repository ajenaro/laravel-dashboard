<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\UserProfile;
use Faker\Generator as Faker;

$factory->define(UserProfile::class, function (Faker $faker) {
    return [
        'website' => $faker->url,
        'job_title' => $faker->jobTitle,
        'phone_number' => $faker->phoneNumber
    ];
});
