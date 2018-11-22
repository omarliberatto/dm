<?php

use Faker\Generator as Faker;

$factory->define(App\Telefono::class, function (Faker $faker) {
    return [
        'alias' => $faker->randomNumber($nbDigits = 4, $strict = true),
        'telefonoscache_id' => 1,
        'ubicacion_id' => 1,
    ];
});
