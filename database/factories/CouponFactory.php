<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Coupon;
use Faker\Generator as Faker;

use Carbon\Carbon;

$factory->define(Coupon::class, function (Faker $faker) {

    $valid_till = Carbon::create('2020', '06', '30')->toDateString();

    return [
        'code' => $faker->word,
        'min_items' => rand(1, 3),
        'min_price' => rand(1, 3)*50,
        'coupon_type' => rand(1, 4),
        'percentage_off' => rand(0, 10),
        'price_off' => rand(0, 10),
        'is_active' => 1,
        'valid_till' => $valid_till
    ];
});
