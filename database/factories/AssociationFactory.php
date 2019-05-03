<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Association;
use Faker\Generator as Faker;

$factory->define(Association::class, function (Faker $faker) {
    return [
        'name'=> $faker->colorName,
        'color'=> $faker->hexColor,
        'user_id'=> null,
    ];
});
