<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Enterprise;
use App\Models\AuthorizationCertificate;
use App\Models\Employee;
use App\Models\Product;
use App\User;
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

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->name
    ];
});

$factory->define(Enterprise::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'title' => $faker->words(3, true),
        'document_number' =>  $faker->cnpj
    ];
});

$factory->define(AuthorizationCertificate::class, function (Faker $faker) {
    return [
        'document_number' => $faker->phoneNumber,
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'end_date' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'document_number' => $faker->cpf,
        'cep' => $faker->postcode,
        'email' => $faker->email,
        'address' => $faker->address,
        'city' => $faker->city,
        'state' => $faker->state,
        'phone' => $faker->phone,
        'enterprise_id' => rand(1, 3),
        'sector_id' => rand(1,10),
        'position_id' => rand(1,30),
        'admission' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'resignation' => $faker->date($format = 'Y-m-d', $min = 'admission')
    ];
});
