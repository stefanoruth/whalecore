<?php

use Faker\Generator as Faker;

/* @var Illuminate\Database\Eloquent\Factory $factory */

$factory->define(App\Media::class, function (Faker $faker) {
    $image = $faker->image('storage/app/public/images', 640, 480, 'cats', false);

    $file = storage_path("app/public/images/{$image}");
    return [
        'file_name' => $image,
        'mime_type' => image_type_to_mime_type(exif_imagetype($file)),
        'size' => filesize($file),
        'disk' => 'public',
    ];
});
