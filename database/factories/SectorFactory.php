<?php

use Faker\Generator as Faker;

$factory->define(App\Sector::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'area_id' => 1,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    ];
});
