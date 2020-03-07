<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Position;
use App\Models\Sector;
use Faker\Generator as Faker;

$factory->define(Sector::class, function (Faker $faker) {
    return [
        'name' => $faker->city,
        'enterprise_id' => rand(1, 3)
    ];
});

$factory->define(Position::class, function (Faker $faker) {
    return [
        'name' => $faker->jobTitle,
        'description' => $faker->words(3, true),
        'enterprise_id' => rand(1, 3),
        'sector_id' => rand(1,10)
    ];
});
