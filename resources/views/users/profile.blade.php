@extends('components.manage-layout')

@section('manage-content')
    <div class="profile-tab mb-3">
        <div class="manage links">
            <a class="active" href="/users">User Profile</a>
            @auth
                @if (auth()->user()->role == 'admin')
                    <a href="{{ route('admin.manage') }}">Manage Listing</a>
                @endif
            @endauth
            <a href="{{ route('users.cart') }}">Shopping cart</a>
            <a href="/users/orders">Placed order</a>
            <a href="/feedbacks">Feedback</a>
        </div>

        <div class="profile-content">
            <form action="{{ route('users.save', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="avatar-area">
                    <div class="title">Profile picture</div>
                    <div class="avatar-pic">
                        <img style="border-radius: 30%" class="w-100"
                            src="{{ auth()->user()->profile_img ? asset('storage/' . auth()->user()->profile_img) : asset('icon/avatar.svg') }}"
                            alt="">
                    </div>
                    <input type="file" class="form-control" name="profile_img" />
                </div>

                <div class="nickname-area mt-3">
                    <div class="title">Username</div>
                    <input type="text" class="form-control" name="username" value="{{ auth()->user()->username }}" />

                    @error('username')
                        <p class="text-red-500 text-xs
                        mt-1">{{ $message }}</p>
                    @enderror
                    <button type="submit" class="btn btn-secondary mt-3">Save</button>

                </div>
            </form>

            <div class="d-flex">
                @if (auth()->user()->role != 'admin')
                    <form action="{{ route('users.toAdmin', auth()->user()->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" class="btn btn-secondary mt-3 me-3">Upgrate to admin</button>
                    </form>
                @endif

                <form action="{{ route('users.deleteAcc', auth()->user()->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-secondary mt-3">Delete account</button>
                </form>
            </div>
        </div>
    </div>
@endsection
