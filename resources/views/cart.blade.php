@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <!-- All list component -->
        <cart-items-component list_items= "{{ $cartItems }}"></cart-items-component>

        <!-- Price Summary Component -->
        <cart-price-summary-component></cart-price-summary-component>
        

        

    </div>
    <div class="row justify-content-center" style="margin-top: 4em">
        <!-- All Store component -->
        <store-items-component store_items= "{{ $storeItems }}"></store-items-component>
		
	</div>
</div>
@endsection
