<?php

use Faker\Generator as Faker;
use Illuminate\Support\Str;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Page::class, function (Faker $faker) {
    $title = $faker->unique()->sentence;

    return [
        'title' => $title,
        'slug' => Str::slug($title),
    ];
});
