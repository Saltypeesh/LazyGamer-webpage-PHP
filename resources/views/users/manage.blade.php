@extends('components.manage-layout')

@section('manage-content')
    <div class="manage-tab">
        <div class="manage links">
            <a href="/users">User Profile</a>
            <a class="active" href="{{ route('admin.manage') }}">Manage Listing</a>
            <a href="{{ route('users.cart') }}">Shopping cart</a>
            <a href="/users/orders">Placed order</a>
            <a href="/feedbacks">Feedback</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th class="d-none d-md-table-cell">Image</th>
                    <th>Title</th>
                    <th>Price($)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @unless ($listings->isEmpty())
                    @foreach ($listings as $listing)
                        <tr>
                            <td class="d-none d-md-table-cell"><a href="/listings/{{ $listing->id }}"><img class="w-100"
                                        src="{{ $listing->banner ? asset('storage/' . $listing->banner) : asset('/images/no-image.jpg') }}"
                                        alt=""></a></td>
                            <td><a href="/listings/{{ $listing->id }}">{{ $listing->title }}</a></td>
                            <td>{{ $listing->price }}</td>
                            <td>
                                <div class="manage-action">
                                    <a href="{{ route('admin.edit', $listing->id) }}" class="btn btn-primary me-2"><i
                                            class="fa-solid fa-pen-to-square"></i> Edit</a>
                                    <form method="POST" action="/listings/{{ $listing->id }}" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"><i
                                                class="fa-solid fa-trash-can me-1"></i>Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td>
                            <p>No Listing Found</p>
                        </td>
                    </tr>
                @endunless
            </tbody>
        </table>
    </div>

@endsection
