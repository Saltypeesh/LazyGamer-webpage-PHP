<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedbackRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FeedbacksResource;

class FeedbacksController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return FeedbacksResource::collection(
            Feedback::where('user_id', Auth::user()->id)->get()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFeedbackRequest $request)
    {
        $feedback = Feedback::where('user_id', auth()->id())->get();

        if (!$feedback->isEmpty()) {
            return back()->with('message', 'User have already created feedback.');
        }

        $request->validated($request->all());

        $feedback = Feedback::create([
            'user_id' => Auth::user()->id,
            'content' => $request->content
        ]);

        return new FeedbacksResource($feedback);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function show($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFeedbackRequest $request, Feedback $feedback)
    {
        if (Auth::user()->id !== $feedback->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }

        $feedback->update($request->all());

        return new FeedbacksResource($feedback);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feedback $feedback)
    {
        return $this->isNotAuthorized($feedback) ? $this->isNotAuthorized($feedback) :  $feedback->delete();
    }

    private function isNotAuthorized($feedback)
    {
        if (Auth::user()->id !== $feedback->user_id) {
            return $this->error('', 'You are not authorized to make this request', 403);
        }
    }
}
