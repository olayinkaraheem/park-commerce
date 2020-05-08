<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Cart;

class CartController extends Controller
{
    public function index() {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();

        // dd($cartItems);
        return view('cart')->withCartItems($cartItems);
    }
}
