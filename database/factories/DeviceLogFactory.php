<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\DeviceLog;
use Faker\Generator as Faker;
use App\Device;

$factory->define(DeviceLog::class, function (Faker $faker) {
	$dt = now()->subDay()->startOfDay();
    return [
        'fp_id' => Device::first()->fp_id,
        'start' => $dt->addMinutes($faker->numberBetween(0,1380)),
        'end' => $dt->copy()->addMinutes($faker->numberBetween(0,45)),
    ];
});
