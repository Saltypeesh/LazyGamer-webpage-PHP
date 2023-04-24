<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ProductsResource;

class ProductsController extends Controller
{
    public function index()
    {
        return ProductsResource::collection(
            Listing::all()
        );
    }

    public function show(Listing $listing)
    {
        return new ProductsResource($listing);
    }
}
