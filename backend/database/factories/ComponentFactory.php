<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Component::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
    ];
});
