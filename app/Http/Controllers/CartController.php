<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Cart;
use App\StoreItem;

class CartController extends Controller
{
    public function index() {
        $cartItems = Cart::where('user_id', auth()->user()->id)->get();
        $storeItems = StoreItem::all();

        // dd($cartItems);
        return view('cart')->withCartItems($cartItems)->withStoreItems($storeItems);
    }

    public function store(Request $request) {
        request()->validate([
            'item_id' => 'required',
            'quantity' => 'required'
        ]);

        $newCartItem = Cart::create([
            'user_id' => auth()->user()->id,
            'item_id' => $request->item_id,
            'quantity' => $request->quantity
        ]);

        return response()->json([
            'new_item' => $newCartItem->fresh()
        ], 201);
    }

    public function remove($id) {
        
        $item = Cart::find($id);

        if($item) {
            if($item->user_id == auth()->user()->id) {
                $item->delete();
                $response = [
                    'message' => 'Item deleted from cart.',
                    'error' => false
                ];
            } else {
                $response = [
                    'message' => 'You are not authorized to perform this action.',
                    'error' => true
                ];
            }
        } else {
            $response = [
                'message' => 'This item does not exist.',
                'error' => true
            ];

        }
        return response()->json($response, $response['error'] ? 400 : 200);
    }
}
