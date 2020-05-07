@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">

            <table class="table table-cart">
                <tbody valign="middle">
                    <tr>
                        <td>
                            <a class="item-remove" href="#"><i class="ti-close"></i></a>
                        </td>
                        
                        <td>
                            <a href="#">
                                <img src="{{ asset('img/product-1.png') }}" alt="...">
                            </a>
                        </td>

                        <td>
                            <h5>Apple Watch 2</h5>
                            <p>Superior Sports Watch</p>
                        </td>

                        <td>
                            <label>Quantity</label>
                            <input class="form-control form-control-sm" type="number" placeholder="Quantity" value="1">
                        </td>

                        <td>
                            <h4 class="price">$349</h4>
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            <a class="item-remove" href="#"><i class="ti-close"></i></a>
                        </td>
                        
                        <td>
                            <a href="#">
                                <img src="{{ asset('img/product-1.png') }}" alt="...">
                            </a>
                        </td>

                        <td>
                            <h5>Apple Watch 2</h5>
                            <p>Superior Sports Watch</p>
                        </td>

                        <td>
                            <label>Quantity</label>
                            <input class="form-control form-control-sm" type="number" placeholder="Quantity" value="1">
                        </td>

                        <td>
                            <h4 class="price">$349</h4>
                        </td>
                    </tr>                    
                    <tr>
                        <td>
                            <a class="item-remove" href="#"><i class="ti-close"></i></a>
                        </td>
                        
                        <td>
                            <a href="#">
                                <img src="{{ asset('img/product-1.png') }}" alt="...">
                            </a>
                        </td>

                        <td>
                            <h5>Apple Watch 2</h5>
                            <p>Superior Sports Watch</p>
                        </td>

                        <td>
                            <label>Quantity</label>
                            <input class="form-control form-control-sm" type="number" placeholder="Quantity" value="1">
                        </td>

                        <td>
                            <h4 class="price">$349</h4>
                        </td>
                    </tr>                    
                </tbody>
            </table>

        </div>


        <div class="col-12 col-lg-4">
            <div class="cart-section">
                <div class="flexbox">
                    <div>
                        <p><strong>Subtotal:</strong></p>
                        <p><strong>Discount:</strong></p>
                    </div>
                    <div>
                        <p>$3917</p>
                        <p>$39</p>
                    </div>
                </div>

                <hr>
                
                <div class="flexbox">
                    <div>
                        <p><strong>Total:</strong></p>
                    </div>
                    <div>
                        <p class="fw-600">$4,351</p>
                    </div>
                </div>
                
            </div>
            <div class="cart-section">
                <div class="flexbox">
                    <input type="text" placeholder="Enter Coupon Code" class="form-control">
                </div>
            </div>
            <div class="text-right">
                <button class="btn btn-primary" type="submit">Apply Coupon<i class="ti-angle-right fs-9"></i></button>
            </div>
        </div>
    </div>
</div>
@endsection
