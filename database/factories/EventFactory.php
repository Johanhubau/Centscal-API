<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Event;
use Faker\Generator as Faker;

$factory->define(Event::class, function (Faker $faker) {
    return [
        'asso_id'=> null,
        'all_day'=> $faker->boolean,
        'start'=> $faker->dateTime,
        'end'=> $faker->dateTime,
        'title'=> $faker->sentence,
        'url'=> $faker->url,
    ];
});
