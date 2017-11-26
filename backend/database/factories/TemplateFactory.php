<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(\App\Template::class, function (Faker $faker) {
    return [
        'title' => $faker->unique()->colorName,
        'type_id' => \App\TemplateType::inRandomOrder()->first()->id,
    ];
});

$factory->state(App\Template::class, 'post', [
    'type_id' => \App\TemplateType::where('name', 'post')->first()->id,
]);

$factory->state(App\Template::class, 'bucket', [
    'type_id' => \App\TemplateType::where('name', 'bucket')->first()->id,
]);

$factory->state(App\Template::class, 'page', [
    'type_id' => \App\TemplateType::where('name', 'page')->first()->id,
]);
