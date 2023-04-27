<x-layout>
    <div class="listing-form">
        <div class="container">
            <div class="header-manage pt-3">
                <h2>Create a platform</h2>
            </div>
            <form class="pb-3" method="POST" action="{{ route('platforms.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="title" class="mb-2">Name</label>
                    <input type="text" class="form-control" name="platname" value="{{ old('platname') }}" />
                    @error('platname')
                        <p class="text-red-500 text-xs
                            mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-secondary">
                        Create platform
                    </button>
                    <a href="/users/platforms" class="btn btn-secondary"> Back </a>
                </div>
            </form>
        </div>
    </div>

</x-layout>