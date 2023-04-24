@extends('components.manage-layout')

@section('manage-content')
    <div class="order-tab">
        <div class="manage links">
            <a href="/users">User Profile</a>
            @auth
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('admin.manage') }}">Manage Listing</a>
                @endif
            @endauth
            <a href="{{ route('users.cart') }}">Shopping cart</a>
            <a class="active" href="/users/orders">Placed order</a>
            <a href="/feedbacks">Feedback</a>
        </div>

        @php
            $total = 0;
        @endphp

        <table class="table">
            <thead>
                <tr>
                    <th class="d-none d-md-table-cell">Image</th>
                    <th>Title</th>
                    <th>Price($)</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @if ($orders->count() != 0)
                    @foreach ($orders as $order)
                        @if ($order->users->id == auth()->user()->id)
                            <tr>
                                <td class="d-none d-md-table-cell"><a href="/listings/{{ $order->listings->id }}">
                                        <img class="w-100"
                                            src="{{ $order->listings->banner ? asset('storage/' . $order->listings->banner) : asset('/images/no-image.jpg') }}"
                                            alt="">
                                    </a></td>
                                <td><a href="/listings/{{ $order->listings->id }}">{{ $order->listings->title }}</a></td>
                                <td>{{ $order->listings->price }}</td>
                                <td>{{ $order->amount }}</td>
                            </tr>

                            @php
                                $total += $order->listings->price * $order->amount;
                                $exist = true;
                            @endphp
                        @endif
                    @endforeach
                @else
                    <tr>
                        <td>
                            <p>No Order Found</p>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>

        <div class="cartpage-right mt-5">
            <h3 class="d-lg-inline-block">Total</h3>

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

            </div>
        </div>
    </div>
@endsection
