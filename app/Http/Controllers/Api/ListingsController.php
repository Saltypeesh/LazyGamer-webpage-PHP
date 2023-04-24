<?php

namespace App\Http\Controllers\Api;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ListingsResource;
use App\Http\Requests\StoreListingRequest;

class ListingsController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role !== "admin") {
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        return ListingsResource::collection(
            Listing::where('user_id', Auth::user()->id)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreListingRequest $request)
    {
        if (Auth::user()->role !== "admin") {
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $request->validated($request->all());

        $listing = Listing::create([
            'user_id' => Auth::user()->id,
            'title' => $request->title,
            'price' => $request->price,
            'tags' => $request->tags,
            'plat_id' => $request->plat_id,
            'banner' => $request->banner,
            'background' => $request->background,
            'description' => $request->description
        ]);

        return new ListingsResource($listing);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return $this->isNotAuthorized($listing) ? $this->isNotAuthorized($listing) :  new ListingsResource($listing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Listing $listing)
    {
        if (Auth::user()->id !== $listing->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $listing->update($request->all());

        return new ListingsResource($listing);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        return $this->isNotAuthorized($listing) ? $this->isNotAuthorized($listing) :  $listing->delete();
    }

    private function isNotAuthorized($listing)
    {
        if (Auth::user()->id !== $listing->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }
}
