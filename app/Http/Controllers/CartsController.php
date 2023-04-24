<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\Listing;
use Illuminate\Http\Request;

class CartsController extends Controller
{
    // Shopping cart 
    public function index()
    {
        $carts = Cart::where('user_id', auth()->id())->get();

        return view('users.shopping_cart', compact('carts'));
    }

    public function store(Request $request)
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        $exist = false;

        $formFields['user_id'] = auth()->id();
        $formFields['listing_id'] = $request->listing_id;

        foreach ($carts as $cart) {
            if ($cart->listing_id == $request->listing_id) {
                $formFields['amount'] = ++$cart->amount;
                $cart->update($formFields);
                $exist = true;
            }
        }

        if (!$exist) {
            Cart::create($formFields);
        }

        return back()->with('message', 'Product has been added to cart!');
    }

    public function buyNow(Request $request)
    {
        $carts = Cart::where('user_id', auth()->id())->get();
        $exist = false;

        $formFields['user_id'] = auth()->id();
        $formFields['listing_id'] = $request->listing_id;

        foreach ($carts as $cart) {
            if ($cart->listing_id == $request->listing_id) {
                $formFields['amount'] = ++$cart->amount;
                $cart->update($formFields);
                $exist = true;
            }
        }

        if (!$exist) {
            Cart::create($formFields);
        }

        return redirect()->route('users.cart')->with('message', 'Process to checkout...');
    }

    public function update(Request $request, Listing $listing)
    {
        $carts = Cart::where('user_id', auth()->id())->get();

        $formFields['user_id'] = auth()->id();
        $formFields['listing_id'] = $listing->id;

        foreach ($carts as $cart) {
            if ($cart->listing_id == $listing->id) {
                $formFields['amount'] = $request->cart_amount;

                $cart->update($formFields);
            }
        }

        return back();
    }

    public function destroy(Listing $listing)
    {

        $user = User::find(auth()->id());
        
        $listing->carts()->detach($user);

        return back()->with('message', 'Item deleted!');
    }
}
