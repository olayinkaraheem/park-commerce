<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CouponTest extends TestCase
{

    use RefreshDatabase;

    /**
     * Test a user can get fixed price off discount
     * 
     * @group test_user_can_get_fixed_price_off
     * 
     * @return void
     */

    public function testUserCanGetFixedPriceOff() {

        $this->withoutExceptionHandling();

        $request_detail = [
            'total_price' => 51,
            'item_count' => 1,
            'coupon-code' => 'FIXED10'
        ];

        $response = $this->postJson('/cart/process-coupon', $request_detail);

        $response->assertStatus(200);
    }
    
    /**
     * Test a user can get percentage of total price off
     * 
     * @group test_user_can_get_percentage_of_price_off
     * 
     * @return void
     */

    public function testUserCanGetPercentageOfPriceOff() {

        $this->withoutExceptionHandling();

        $request_detail = [
            'total_price' => 101,
            'item_count' => 2,
            'coupon-code' => 'PERCENT10'
        ];

        $response = $this->postJson('/cart/process-coupon', $request_detail);

        $response->assertStatus(200);
    }
    
    
    /**
     * Test a user can get either percentage of total price off
     * 
     * or fixed price off
     * 
     * @group test_user_can_get_either_percentage_of_or_fixed_price_off
     * 
     * @return void
     */

    public function testUserCanGetPercentageOrFixedPriceOff() {

        $this->withoutExceptionHandling();

        $request_detail = [
            'total_price' => 201,
            'item_count' => 3,
            'coupon-code' => 'MIXED10'
        ];

        $response = $this->postJson('/cart/process-coupon', $request_detail);

        $response->assertStatus(200);
    }
    

    /**
     * Test a user can get both percentage of total price off
     * 
     * and fixed price off
     * 
     * @group test_user_can_get_both_percentage_of_and_fixed_price_off
     * 
     * @return void
     */

    public function testUserCanGetBothPercentageAndFixedPriceOff() {

        $this->withoutExceptionHandling();

        $request_detail = [
            'total_price' => 1001,
            'item_count' => 1,
            'coupon-code' => 'REJECTED10'
        ];

        $response = $this->postJson('/cart/process-coupon', $request_detail);

        $response->assertStatus(200);
    }
}
