<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Carbon\Carbon;
use App\User;
use App\Models\Books\Book;
use App\Models\Loans\Loan;
use App\Models\Readers\Reader;
use Faker\Generator as Faker;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

$factory->define(Book::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, true),
        'author' => $faker->name,
        'condition' => $faker->numberBetween(1, 100)
    ];
});

$factory->define(Reader::class, function (Faker $faker) {
    return [
        'lastname' => $faker->lastName,
        'firstname' => $faker->firstName,
        'patronymic' => null,
    ];
});

$factory->define(Loan::class, function (Faker $faker) {
    return [
        'expires_at' => Carbon::now()->addDays($faker->numberBetween(1, 180))->toString()
    ];
});
