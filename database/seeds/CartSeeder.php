<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carts')->insert([
            'user_id' => 1,
            'item_id' => 4,
            'quantity' => 2,
        ]);
        DB::table('carts')->insert([
            'user_id' => 1,
            'item_id' => 2,
            'quantity' => 1,
        ]);
    }
}
