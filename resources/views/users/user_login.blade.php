<x-layout>
    <div class="listing-form m_login">
        <div class="container">
            <div class="header-manage pt-3">
                <h2>Login</h2>
                <p class="mb-4">Log into your account to listing games</p>
            </div>

            <form class="pb-3" method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="email" class="mb-2">Email</label>
                    <input type="text" placeholder="Enter email" class="form-control" name="email"
                        value="{{ old('username') }}" />

                    @error('email')
                        <p class="text-red-500 text-xs
                            mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="password" class="mb-2">Password</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}" />

                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>


                <div class="mt-4">
                    <button type="submit" class="w-100 btn btn-warning">
                        Login
                    </button>
                </div>

                <div class="action">
                    <a href="{{ route('users.register') }}">Don't have an account?</a>
                    <a href="#">Lost password?</a>
                </div>
            </form>
        </div>
    </div>

</x-layout>
