<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use App\Http\Requests\StoreListingRequest;
use App\Models\Platform;

class ListingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['home', 'index', 'show']]);
    }

    public function home()
    {
        return view('listings.home', [
            'listings' => Listing::All()
        ]);
    }

    public function index()
    {
        $listings = Listing::latest()
            ->filter(request(['tag', 'platform', 'search']))
            ->paginate(6)->withQueryString();

        return view('listings.index', compact('listings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $platforms = Platform::all();

        return view('listings.create')->with('platforms', $platforms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->merge([
            'tags' => self::arrayToString($request->tags)
        ]);

        $formFields = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric|between:0.99,199.99',
            'tags' => 'required',
            'plat_id' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('banner')) {
            $formFields['banner'] = $request->file('banner')->store('banners', 'public');
        }

        if ($request->hasFile('background')) {
            $formFields['background'] = $request->file('background')->store('backgrounds', 'public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);

        return redirect('/listings')->with('message', 'Listing created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view('listings.show', [
            'listing' => $listing
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Listing $listing)
    {

        $platforms = Platform::all();

        return view('listings.edit', ['listing' => $listing])->with('platforms', $platforms);
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
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $request->merge([
            'tags' => self::arrayToString($request->tags)
        ]);


        $formFields = $request->validate([
            'title' => 'required',
            'price' => 'required|numeric|between:0.99,199.99',
            'tags' => 'required',
            'plat_id' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('banner')) {
            $formFields['banner'] = $request->file('banner')->store('banners', 'public');
        }

        if ($request->hasFile('background')) {
            $formFields['background'] = $request->file('background')->store('backgrounds', 'public');
        }

        $listing->update($formFields);



        return redirect()->route('admin.manage')->with('message', 'Listing updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        // Make sure logged in user is owner
        if ($listing->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $listing->delete();
        // return redirect('/listings')->with('message', 'Game listing deleted successfully!');
        return back()->with('message', 'Game listing deleted successfully!');
    }

    // Convert array to String
    private function arrayToString($arr)
    {
        $tagsValue = "";
        if ($arr != null) {
            for ($i = 0; $i < count($arr); $i++) {
                if ($i != 0) {
                    $tagsValue .= ",";
                }
                $tagsValue .= $arr[$i];
            }
        }
        return $tagsValue;
    }
}
