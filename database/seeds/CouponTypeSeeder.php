<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CouponTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('coupon_types')->insert([
            'title' => 'Fixed price off',
            'description' => 'Coupon type with fix discount off total price.',
            'type' => 1,
        ]);
        DB::table('coupon_types')->insert([
            'title' => 'Percent off',
            'description' => 'Coupon type with discount of a percentage off the total price.',
            'type' => 2,
        ]);
        DB::table('coupon_types')->insert([
            'title' => 'Mixed',
            'description' => 'Coupon type with discount of either a fixed price or a percentage off the total price. Which ever is greater.',
            'type' => 3,
        ]);
        DB::table('coupon_types')->insert([
            'title' => 'Reject',
            'description' => 'Coupon type with discount of both fixed price and  percentage off the total price.',
            'type' => 4,
        ]);
    }
}
