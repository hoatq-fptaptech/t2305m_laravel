@extends('layout.layout')
@section("breadcrumb")
    <div class="breadcrumb__text">
        <h2>Checkout</h2>
        <div class="breadcrumb__option">
            <a href="./index.html">Home</a>
            <span>Shop</span>
        </div>
    </div>
@endsection
@section("main")
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form action="#">
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input name="first_name" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input name="last_name" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <textarea name="shipping_address" class="form-control" placeholder="Shipping Address"></textarea>
                            </div>
                            <div class="checkout__input">
                                <p>City<span>*</span></p>
                                <input name="city" type="text">
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Telephone<span>*</span></p>
                                        <input name="telephone" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input name="email" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Order notes</p>
                                <input name="order_note" type="text"
                                       placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="free_ship">
                                    Free Shipping
                                    <input name="shipping_method"  value="free" type="radio" id="free_ship">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="standard">
                                    Standard (+10$)
                                    <input name="shipping_method"  value="standard" type="radio" id="standard">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="express">
                                    Express (+20$)
                                    <input name="shipping_method"  value="express" type="radio" id="express">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Total</span></div>
                                <ul>
                                    @foreach($cart as $item)
                                        <li>{{$item->name}} <small>({{$item->buy_qty}}x${{$item->price}})</small> <span>${{$item->price*$item->buy_qty}}</span></li>
                                    @endforeach

                                </ul>
                                <div class="checkout__order__subtotal">Subtotal <span>${{$total}}</span></div>
                                <div class="checkout__order__total">Total <span>${{$total}}</span></div>
                                <div class="checkout__input__checkbox">
                                    <label for="payment">
                                        COD
                                        <input name="payment_method" value="COD" type="radio" id="payment">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="checkout__input__checkbox">
                                    <label for="paypal">
                                        Paypal
                                        <input name="payment_method" value="Paypal" type="radio" id="paypal">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
