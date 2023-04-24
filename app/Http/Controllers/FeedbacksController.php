<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbacksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'index']);
    }

    public function index()
    {
        $feedbacks = Feedback::latest()->paginate(8);
        $feedbacks_all = Feedback::all();

        return view('users.feedback', compact('feedbacks', 'feedbacks_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     $feedbacks = Feedback::paginate(8);

    //     return view('users.feedbacks', compact('feedbacks'));
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $feedback = Feedback::where('user_id', auth()->id())->get();

        if (!$feedback->isEmpty()) {
            return back()->with('message', 'User have already created feedback.');
        }

        $formFields = $request->validate([
            'content' => 'required'
        ]);

        $formFields['user_id'] = auth()->id();

        Feedback::create($formFields);

        return back()->with('message', 'Feedback created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    // public function show(Feedback $feedback)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    // public function edit(Feedback $feedback)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feedback $feedback)
    {
        // Make sure logged in user is owner
        if ($feedback->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        if ($request->content == '') {
            $feedback->delete();
            return back()->with('message', 'Feedback updated successfully!');
        }

        $formFields['content'] = $request->content;

        $feedback->update($formFields);

        return back()->with('message', 'Feedback updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Feedback  $feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        // Make sure logged in user is owner
        if ($feedback->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }

        $feedback->delete();
        return back()->with('message', 'Feedback deleted successfully!');
    }
}
