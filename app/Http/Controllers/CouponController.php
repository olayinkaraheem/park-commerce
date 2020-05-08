<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Handlers\CouponHandler;

class CouponController extends Controller
{

    /**
     * Processes the the request sent .
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        if($request->coupon_code) {
    
            $process = new CouponHandler($request);
            $processed = $process->processRequest();
            // dd($processed);
            if($processed['status'] == 'OK') {
                // set success flash message here
            } else {
                // set error flash message here
            }
            $response = response()->json([
                'status' => $processed['status'],
                'message' => $processed['message'],
                'data' => $processed['discounted_price'] ?? $request->total_price
            ], $processed['code']);
    
        } else {
            $response = response()->json([
                'message' => 'No coupon code supplied'
            ], 400);
        }
    
        return $response;
    
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
