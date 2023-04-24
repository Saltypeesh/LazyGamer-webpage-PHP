<x-layout>
    <div class="listing-form m_login">
        <div class="container">
            <div class="header-manage pt-3">
                <h2>Register</h2>
                <p class="mb-4">Create an account to listing games</p>
            </div>

            <form class="pb-3" method="POST" action="{{ route('users.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="username" class="mb-2">Username</label>
                    <input type="text" class="form-control" name="username" value="{{ old('username') }}" />

                    @error('username')
                        <p class="text-red-500 text-xs
                            mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="email" class="mb-2">Email</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" />

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

                <div class="mb-2">
                    <label for="password_confirmation" class="mb-2">Confirm password</label>
                    <input type="password" class="form-control" name="password_confirmation"
                        value="{{ old('password') }}" />

                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="regs action">
                    <span class="me-2">Already have an account?</span>
                    <a href="{{ route('login-view') }}">Login</a>
                </div>

                <div class="mt-3">
                    <button type="submit" class="w-100 btn btn-warning">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
