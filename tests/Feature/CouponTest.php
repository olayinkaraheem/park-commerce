<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Coupon;

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

        $coupon = factory(Coupon::class)->create([
            'code' => 'FIXED10',
            'min_items' => 1,
            'min_price' => 50,
            'coupon_type' => 1,
            'percentage_off' => 0,
            'price_off' => 10,
        ]);

        $request_detail = [
            'total_price' => 51,
            'item_count' => 1,
            'coupon_code' => 'FIXED10'
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

        $coupon = factory(Coupon::class)->create([
            'code' => 'PERCENT10',
            'min_items' => 2,
            'min_price' => 100,
            'coupon_type' => 2,
            'percentage_off' => 10,
            'price_off' => 0,
        ]);

        $request_detail = [
            'total_price' => 101,
            'item_count' => 2,
            'coupon_code' => 'PERCENT10'
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

        $coupon = factory(Coupon::class)->create([
            'code' => 'MIXED10',
            'min_items' => 3,
            'min_price' => 200,
            'coupon_type' => 3,
            'percentage_off' => 10,
            'price_off' => 10,
        ]);

        $request_detail = [
            'total_price' => 201,
            'item_count' => 3,
            'coupon_code' => 'MIXED10'
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

        $coupon = factory(Coupon::class)->create([
            'code' => 'REJECTED10',
            'min_items' => 1,
            'min_price' => 1000,
            'coupon_type' => 4,
            'percentage_off' => 10,
            'price_off' => 10,
        ]);

        $request_detail = [
            'total_price' => 1001,
            'item_count' => 1,
            'coupon_code' => 'REJECTED10'
        ];

        $response = $this->postJson('/cart/process-coupon', $request_detail);

        $response->assertStatus(200);
    }

    /**
     * Test system should fail for invalid coupon code
     * 
     * and fixed price off
     * 
     * @group test_should_fail_invalid_coupon_code
     * 
     * @return void
     */

    public function testCouponCodeIsInvalid() {

        $this->withoutExceptionHandling();

        $request_detail = [
            'total_price' => 1001,
            'item_count' => 1,
            'coupon_code' => 'REJECTED1'
        ];

        $response = $this->postJson('/cart/process-coupon', $request_detail);

        $response->assertStatus(400);

        $response->assertJson([
            "message" => "Invalid coupon supplied."
        ]);
    }
    
    
    /**
     * Test system should fail for expired coupon code
     * 
     * and fixed price off
     * 
     * @group test_should_fail_expired_coupon_code
     * 
     * @return void
     */

    public function testCouponCodeIsExpired() {

        $this->withoutExceptionHandling();

        $coupon = factory(Coupon::class)->create([
            'valid_till' => '2020-04-10',
            // 'is_active' => 1
        ]);

        $request_detail = [
            'total_price' => $coupon->min_price,
            'item_count' => $coupon->min_items,
            'coupon_code' => $coupon->code
        ];

        $response = $this->postJson('/cart/process-coupon', $request_detail);

        $response->assertStatus(400);
        $response->assertJson([
            'message' =>"Coupon is expired."
        ]);
    }

    /**
     * Test system should not fail for new coupon code / rule
     * 
     * @group test_should_pass_new_coupon_code
     * 
     * @return void
     */

    public function testNewRuleShoulPass() {

        $this->withoutExceptionHandling();

        $coupon = factory(Coupon::class)->create();

        $request_detail = [
            'total_price' => $coupon->min_price+1,
            'item_count' => $coupon->min_items,
            'coupon_code' => $coupon->code
        ];

        // dd([ $coupon, $request_detail]);

        $response = $this->postJson('/cart/process-coupon', $request_detail);

        $response->assertStatus(200);
        // $response->assertJson([
        //     'message' =>"Coupon is expired."
        // ]);
    }
}
