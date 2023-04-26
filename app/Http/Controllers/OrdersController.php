<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Listing;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return view('users.order', compact('orders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'cart_id' => 'required'
        ]);
        $formFields['user_id'] = auth()->id();
        
        Order::create($formFields);

        // $user = User::find(auth()->id());
        // $listing = Listing::find($request->listing_id);
        // $listing->carts()->detach($user);
        
        
        return redirect()->route('home')->with('message', 'Order has been placed!');
    }
}
