<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Bucket::class, function (Faker $faker) {
    return [
        'title' => $faker->word(),
    ];
});
