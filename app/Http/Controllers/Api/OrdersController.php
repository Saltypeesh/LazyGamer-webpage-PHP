<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrdersResource;


class OrdersController extends Controller
{
    public function index()
    {
        return OrdersResource::collection(
            Order::where('user_id', Auth::user()->id)->get()
        );
    }

}
