<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Device::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'fp_id' => $faker->unique()->numberBetween(1,99),
        'name' => $faker->word,
        'description' => $faker->text(100),
    ];
});
