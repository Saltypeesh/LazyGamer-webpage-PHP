@extends('components.manage-layout')

@section('manage-content')
    <div class="manage links">
        <a href="/users">User Profile</a>
        @auth
            @if (auth()->user()->role == 'admin')
                <a href="{{ route('admin.manage') }}">Manage Listing</a>
            @endif
        @endauth
        <a class="active" href="{{ route('users.cart') }}">Shopping cart</a>
        <a href="/users/orders">Placed order</a>
        <a href="/feedbacks">Feedback</a>
    </div>

    <div class="cartpage-container">
        <div class="container d-lg-flex">
            <div class="cartpage-left">
                <h2>Cart</h2>

                <div class="cart-listing">
                    @php
                        $total = 0;
                    @endphp

                    @if ($carts->count() != 0)
                        @foreach ($carts as $cart)
                            <div class="cart-item">
                                <div class="item-container d-flex">
                                    <a href="/listings/{{ $cart->listing->id }}" class="cover">
                                        <img src="{{ $cart->listing->banner ? asset('storage/' . $cart->listing->banner) : asset('/images/no-image.jpg') }}"
                                            class="d-inline-block">
                                    </a>
                                    <div class="information">
                                        <div class="name"><a href="/listings/{{ $cart->listing->id }}">
                                                <span class="title">{{ $cart->listing->title }}</span></a>
                                        </div>
                                        <div class="action">
                                            <div class="deleteItem">
                                                <form method="POST" action="listings/{{ $cart->listing->id }}">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn" style="padding: 0">
                                                        <i style="color: #999" class="fa-solid fa-trash-can"></i>
                                                        <span class="ps-1 d-none d-sm-inline"
                                                            style="color: #999; border-left: 1px solid #999">
                                                            Remove from Cart
                                                        </span>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="price-container">
                                        <div class="price">$ {{ $cart->listing->price }}</div>
                                        <form method="POST" action="{{ route('users.update', $cart->listing->id) }}">
                                            @csrf
                                            @method('PUT')

                                            <select name="cart_amount" onchange="this.form.submit()" class="form-select"
                                                aria-label="Default select example">
                                                @for ($i = 1; $i <= 10; $i++)
                                                    <option value="{{ $i }}"
                                                        {{ $i == $cart->amount ? 'selected' : '' }}>
                                                        {{ $i }}</option>
                                                @endfor
                                            </select>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <form class="allforms" name="order" action="/users/orders" method="POST">
                                @csrf
                                <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                            </form>

                            @php
                                $total += $cart->listing->price * $cart->amount;
                            @endphp
                        @endforeach
                    @else
                        <div class="cart-empty">
                            <div class="icon-cart"><img src="{{ asset('icon/icon-cart.svg') }}" class="w-100">
                            </div>
                            <h2 class="title">Your cart is empty</h2>
                            <span class="content mb-3">You didn't add any item in your cart yet. Browse the website to find
                                amazing deals!
                            </span>
                            <a href="/listings" class="btn">Discover games</a>
                        </div>
                    @endif

                </div>
            </div>

            <div class="cartpage-right">
                <h2 class="d-none d-lg-inline-block">Sumary</h2>

                <div class="cart-summary">
                    <div class="summary-row">
                        <span>Official price</span>
                        <span>$ {{ $total }}</span>
                    </div>

                    <div class="summary-row">
                        <span>Discount</span>
                        <span>$ 0</span>
                    </div>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>$ {{ $total }}</span>
                    </div>

                    <a href="/users/orders" id="allsubmit" class="btn btn-warning checkout">Checkout
                        <i class="ms-2 fa-solid fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
