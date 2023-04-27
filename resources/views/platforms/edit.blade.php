<x-layout>
    <div class="listing-form">
        <div class="container">
            <div class="header-manage pt-3">
                <h2>Edit platform info</h2>
            </div>
            <form class="pb-3" action="{{ route('platforms.update', ['platform'=>$platform]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-2">      
                    <label for="platname" class="mb-2">Platform name:</label>
                    <input type="text" class="form-control" name="platname" value="{{ $platform->platname }}" />
                    @error('platname')
                        <p class="text-red-500 text-xs
                            mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-secondary">
                        Confirm edit
                    </button>
                    <a href="/platforms" class="btn btn-secondary"> Back </a>
                </div>
            </form>
        </div>
    </div>

</x-layout>