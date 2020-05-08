<?php

namespace App\Handlers;

// use App\Http\Requests\CouponRequest;
use Illuminate\Http\Request;
use \App\Coupon;

class CouponHandler {

    private $request;
    private $coupon;
    private $coupon_type;

    public $response;

    public function __construct(Request $request){
        $this->request = $request;

        // return ['1'=>2];

        // dd('here');

        // process function

        // return $this->processRequest();
    }

    public function processRequest() {

        // validate coupon
        $coupon_validation_response = $this->validateCoupon();

        if($coupon_validation_response['code'] == 200) {
            $this->coupon = $coupon_validation_response['data'];
        } else {
            return $coupon_validation_response;
        }

        // check if request meets coupon requirement
        $coupon_requirement_check_response = $this->checkCouponMeetsRequirement();
        if($coupon_requirement_check_response['code'] == 200) {
            
            // apply coupon; return the result of calculation here
            $this->applyCoupon();

            if($this->response) {
                $response = [
                    'code' => 200,
                    'status' => 'OK',
                    'message' => 'Coupon applied successfully.',
                    'discounted_price' => $this->response['discounted_total']
                ];
            } else {
                $response = [
                    'code' => 400,
                    'status' => 'OA',
                    'message' => 'Something went wrong. Please contact admin.',
                    // 'discounted_price' => $this->request->total_price
                ];
            }

            return $response;

        } else {

            return $coupon_requirement_check_response;

        }

    }

    public function applyCoupon() {
        switch ($this->coupon_type) {
            case 1:
                $this->applyFixedPriceOff();
            break;

            case 2:
                $this->applyPercentagePriceOff();
            break;

            case 3:
                $this->applyMixed();
            break;

            case 4:
                $this->applyRejected();
            break;

            default:
                // dicide what to do here later
                
        }
    }

    /**
     * Checks if the request meets the coupon requirement
     * 
     * @return array $response; the response holding the result of requirement check 
     */
    public function checkCouponMeetsRequirement() {
        // use switch here, switch between coupon_type
        $coupon = $this->coupon;
        $request = $this->request;

        if($request->item_count >= $coupon->min_items && $request->total_price > $coupon->min_price) {

            $this->coupon_type = $coupon->coupon_type;

            $response = [
                'code' => 200,
                'status' => 'OK',
                'message' => 'Coupon requirement check OK.'
            ];
        } else {
            $response = [
                'code' => 400,
                'status' => 'OA',
                'message' => 'You are not eligible to use this coupon.'
            ];
        }

        return $response;
        
    }

    /**
     * Validate the coupon from the request
     * 
     * Verifies the coupon exist and it's still active
     * @return array $response; the response holding the result of validation 
     */

    public function validateCoupon() {

        // $coupon_detail = Coupon::where('code', '=' ,$this->request->coupon_code)->get();
        // dd($this->request->coupon_code);
        // fetch coupon from db
        $coupon_detail = Coupon::where('code', $this->request->coupon_code)->get()->first();
        // dd($coupon_detail);
        // check if it is still valid
        if($coupon_detail) {
            if( strtotime($coupon_detail->valid_till) < strtotime("today") ) {
                $response = [
                    'code' => 400,
                    'status' => 'OB',
                    'message' => 'Coupon is expired.'
                ];
            } else  {
                if($coupon_detail->is_active) {
                    $response = [
                        'code' => 200,
                        'status' => 'OK',
                        'message' => 'Coupon detail found',
                        'data' => $coupon_detail
                    ];
                } else {
                    $response = [
                        'code' => 400,
                        'status' => 'OA',
                        'message' => 'Coupon is inactive.'
                    ];
                }
            }
        } else {
            $response = [
                'code' => 400,
                'status' => 'OB',
                'message' => 'Invalid coupon supplied.'
            ];
        }

        return $response;
    }

    public function applyFixedPriceOff() {
        $price_off = $this->coupon->price_off;

        $new_total = $this->request->total_price - $price_off;

        $this->response = [
            'discounted_total' => $new_total
        ];
    }

    public function applyPercentagePriceOff() {

        $percent_off = $this->coupon->percentage_off;

        $discount = $this->request->total_price * ($percent_off/100);

        $new_total = $this->request->total_price - $discount;

        $this->response = [
            'discounted_total' => $new_total
        ];
    }

    public function applyMixed() {
        
        $price_off = $this->coupon->price_off;
        $percent_off = $this->coupon->percentage_off;

        $discount_by_percetage = $this->request->total_price * ($percent_off/100);

        $discount = $discount_by_percetage > $price_off ? $discount_by_percetage : $price_off;

        $new_total = $this->request->total_price - $discount;

        $this->response = [
            'discounted_total' => $new_total
        ];
    }

    public function applyRejected() {

        $price_off = $this->coupon->price_off;
        $percent_off = $this->coupon->percentage_off;
        
        $discount_by_percetage = $this->request->total_price * ($percent_off/100);

        $discount = $discount_by_percetage + $price_off;

        $new_total = $this->request->total_price - $discount;

        $this->response = [
            'discounted_total' => $new_total
        ];
    }


}