<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\StoreItem;
use Faker\Generator as Faker;

use Illuminate\Support\Facades\DB;

$factory->define(StoreItem::class, function (Faker $faker) {

    $last_id = DB::table('store_items')->latest()->first()->id ?? null;
    $item_name_end = is_numeric($last_id) ? ++$last_id : 1;
    return [
        'name' => 'Product '. $item_name_end,
        'description' => $faker->paragraph(),
        'in_stock' => rand(10, 50),
        'image_url' => $faker->imageUrl(),
        'price' => rand(100, 1000) * 5 // multiple of 5
    ];
});
