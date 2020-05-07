<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $valid_till = Carbon::create('2020', '06', '30');

        DB::table('coupons')->insert([
            'code' => 'FIXED10',
            'min_items' => 1,
            'min_price' => 50,
            'coupon_type' => 1,
            'percentage_off' => 0,
            'price_off' => 10,
            'is_active' => 1,
            'valid_till' => $valid_till
        ]);
        DB::table('coupons')->insert([
            'code' => 'PERCENT10',
            'min_items' => 2,
            'min_price' => 100,
            'coupon_type' => 2,
            'percentage_off' => 10,
            'price_off' => 0,
            'is_active' => 1,
            'valid_till' => $valid_till
        ]);
        DB::table('coupons')->insert([
            'code' => 'MIXED10',
            'min_items' => 3,
            'min_price' => 200,
            'coupon_type' => 3,
            'percentage_off' => 10,
            'price_off' => 10,
            'is_active' => 1,
            'valid_till' => $valid_till
        ]);
        DB::table('coupons')->insert([
            'code' => 'REJECTED10',
            'min_items' => 1,
            'min_price' => 1000,
            'coupon_type' => 4,
            'percentage_off' => 10,
            'price_off' => 10,
            'is_active' => 1,
            'valid_till' => $valid_till
        ]);
    }
}
