<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\CartsResource;
use App\Http\Requests\StoreCartRequest;

class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CartsResource::collection(
            Cart::where('user_id', Auth::user()->id)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCartRequest $request)
    {
        $request->validated($request->all());

        $cart = Cart::create([
            'user_id' => Auth::user()->id,
            'listing_id' => $request->listing_id,
            'amount' => $request->amount
        ]);

        return new CartsResource($cart);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cart $cart)
    {
        return $this->isNotAuthorized($cart) ? $this->isNotAuthorized($cart) :  new CartsResource($cart);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
        if (Auth::user()->id !== $cart->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $cart->update($request->all());

        return new CartsResource($cart);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cart $cart)
    {
        return $this->isNotAuthorized($cart) ? $this->isNotAuthorized($cart) :  $cart->delete();
    }

    private function isNotAuthorized($cart)
    {
        if (Auth::user()->id !== $cart->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }
}
