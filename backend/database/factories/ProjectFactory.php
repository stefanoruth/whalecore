<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        'title' => $faker->domainName,
        'language_code' =>  \App\Language::inRandomOrder()->first()->code,
    ];
});
