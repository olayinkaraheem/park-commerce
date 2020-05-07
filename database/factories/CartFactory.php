<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cart;
use Faker\Generator as Faker;

$factory->define(Cart::class, function (Faker $faker) {
    return [
        'item_id' => rand(1, 4),
        'user_id' => 1,
        'quantity' => rand(1, 5)
    ];
});
