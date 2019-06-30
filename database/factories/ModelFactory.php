<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Movie::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->numberBetween(99999, 999999),
        'rating' => $faker->numberBetween(3, 6),
        'cover_image' => '',
        'date' => $faker->dateTime(),
    ];
});

$factory->define(App\HungarianMovie::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->numberBetween(99999, 999999),
        'title' => '',
        'comment' => '',
    ];
});

$factory->define(App\Mafab::class, function (Faker\Generator $faker) {
    return [
        'id' => null,
    ];
});

$factory->define(App\IMDb::class, function (Faker\Generator $faker) {
    return [
        'id' => $faker->unique()->numberBetween(99999, 999999),
        'title' => '',
        'comment' => '',
    ];
});
