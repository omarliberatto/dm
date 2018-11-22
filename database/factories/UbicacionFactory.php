<?php

use Faker\Generator as Faker;

$factory->define(App\Ubicacion::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        'ini_range' => $faker->randomNumber($nbDigits = 3, $strict = false),
        'end_range' => $faker->randomNumber($nbDigits = 3, $strict = false),
    ];
});
