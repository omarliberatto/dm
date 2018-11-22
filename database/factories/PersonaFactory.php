<?php

use Faker\Generator as Faker;

$factory->define(App\Persona::class, function (Faker $faker) {
    return [
        'full_name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'legajo' => $faker->randomNumber($nbDigits = 5, $strict = false),
    ];
});
