<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Movie;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Movie::class, function (Faker $faker) {
    return [
        'rating' => $faker->numberBetween(3, 6),
        'cover_image' => $faker->url,
        'date' => $faker->date(),
        'hu_title' => Str::random(20),
        'hu_comment' => Str::random(20),
        'mafab_id' => Str::random(20),
        'en_title' => Str::random(20),
        'en_comment' => Str::random(20),
        'imdb_id' => $faker->unique()->numberBetween(1, 999_999_999),
    ];
});
