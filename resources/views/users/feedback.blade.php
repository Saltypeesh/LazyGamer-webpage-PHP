<x-layout>
    <div class="space d-md-none "></div>

    <section class="feedback mt-5 mb-5">
        <div class="container">
            <h1 style="font-size: 27px" class="mb-3">Comment</h1>

            <div class="past-feedback">
                @foreach ($feedbacks as $feedback)
                    <div class="row mb-3">

                        <div class="col-3 col-sm-2 col-md-1">
                            <div class="user-content">
                                <div class="user-avatar mb-1">
                                    <img style="border-radius: 30%; background-color: #101010" class="w-100"
                                        src="{{ $feedback->user->profile_img ? asset('storage/' . $feedback->user->profile_img) : asset('icon/avatar.svg') }}"
                                        alt="">
                                </div>
                                <div class="name" style="font-weight:bold; text-align:center">
                                    {{ $feedback->user->username }}
                                </div>
                            </div>
                        </div>

                        <div class="col-9 col-sm-10 col-md-11">
                            <div class="feedback-content">
                                <p id="p_feedback_{{ $feedback->id }}">{{ $feedback->content }}</p>

                                @auth
                                    @if ($feedback->user_id == auth()->user()->id)
                                        <div id="feedback-action_{{ $feedback->id }}" class="feedback-action">
                                            <button type="button" class="btn edit-feedback"
                                                data-feedback="{{ $feedback->id }}"
                                                id="feedback_{{ $feedback->id }}">Edit</button>

                                            <form action="/feedbacks/{{ $feedback->id }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn" type="submit">Delete</button>
                                            </form>
                                        </div>

                                        <form action="/feedbacks/{{ $feedback->id }}" method="POST">
                                            <textarea name="content" id="textarea_feedback_{{ $feedback->id }}" style="display: none" rows="3">{{ $feedback->content }}</textarea>
                                            <div id="feedback-action_edit_{{ $feedback->id }}"
                                                class="feedback-action_edit" style="display: none">
                                                @csrf
                                                @method('PUT')

                                                <button class="btn" type="submit">Update</button>

                                                <button type="button" class="btn cancel-feedback"
                                                    data-feedback="{{ $feedback->id }}"
                                                    id="feedback_{{ $feedback->id }}">Cancel</button>
                                            </div>
                                        </form>
                                    @endif
                                @endauth

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mb-5 d-flex" style="justify-content: end">
                {{ $feedbacks->links() }}
            </div>

            @php
                $exist = false;
            @endphp


            @auth
                @foreach ($feedbacks_all as $feedback)
                    @if ($feedback->user_id == auth()->user()->id)
                        @php
                            $exist = true;
                        @endphp
                    @endif
                @endforeach

                @if ($exist != true)
                    <div class="new-feedback mt-3">
                        <div class="panel panel-default">
                            <h1 style="font-size: 27px"> Give a Feedback</h1>

                            <div class="panel-body">
                                <form role="form" method="POST" action="{{ url('/feedbacks') }}">
                                    {{ csrf_field() }}
                                    <div class="form-group">

                                        <div class="mb-2">
                                            <label class="mb-3">Hello
                                                {{ auth()->user()->username }}, please give us a feedback
                                            </label>
                                            <textarea class="form-control" name="content" cols="30" rows="5" style="resize: none"></textarea>

                                            @error('content')
                                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" style="background-color: #FF5400; padding: 10px 30px"
                                            class="btn btn-secondary">Submit</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                @endif
            @endauth

        </div>

    </section>

</x-layout>
