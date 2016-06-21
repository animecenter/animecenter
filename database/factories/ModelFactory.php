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

$factory->define(AC\Models\Anime::class, function (Faker\Generator $faker) {
    return [
        'mal_id'             => rand(1, 20000),
        'title'              => $faker->unique()->name,
        'slug'               => $faker->unique()->slug,
        'synopsis'           => rand(0, 1) === 1 ? $faker->text : null,
        'type_id'            => rand(0, 1) === 1 ? rand(1, 7) : null,
        'number_of_episodes' => rand(0, 1) === 1 ? rand(1, 24) : null,
        'status_id'          => rand(1, 3),
        'year'               => $faker->year(),
        'release_date'       => $faker->date(),
        'end_date'           => rand(0, 1) === 1 ? $faker->date() : null,
        'duration'           => rand(0, 1) === 1 ? $faker->time() : null,
        'calendar_season'    => rand(0, 1) === 1 ? ['Spring', 'Summer', 'Fall', 'Winter'][rand(0, 3)] : null,
        'classification_id'  => rand(0, 1) === 1 ? rand(1, 6) : null,
        'active'             => rand(0, 1),
    ];
});

$factory->define(AC\Models\User::class, function (Faker\Generator $faker) {
    return [
        'username'       => $faker->unique()->userName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'active'         => rand(0, 1),
    ];
});
