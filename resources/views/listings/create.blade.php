<x-layout>
    <div class="listing-form">
        <div class="container">
            <div class="header-manage pt-3">
                <h2>Create a Game Listing</h2>
                <p class="mb-4">Post a game listing for sale</p>
            </div>

            <form class="pb-3" method="POST" action="{{ route('admin.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-2">
                    <label for="title" class="mb-2">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ old('title') }}" />

                    @error('title')
                        <p class="text-red-500 text-xs
                            mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="price" class="mb-2">Price</label>
                    <input type="number" step="0.01" min="0.99" max="199.99" class="form-control"
                        name="price" value="{{ old('price') }}" />

                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2 selection">
                    <label for="tags[]" class="mb-2">
                        Tags
                    </label>

                    <select class="js-example-basic-multiple form-select" name="tags[]" multiple="multiple">
                        @php
                            $tagOption = ['Adventure', 'Action', "Beat'em-all", 'Early-Access', 'Multiplayer', 'Indies', 'Online', 'RPG', 'Sport', 'Simulation', 'Strategy', 'Single-player', 'Other'];
                        @endphp

                        @for ($i = 0; $i < count($tagOption); $i++)
                            <option value="{{ $tagOption[$i] }}">{{ $tagOption[$i] }}</option>
                        @endfor>
                    </select>

                    @error('tags')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2 selection">
                    <label for="plat_id" class="mb-2">
                        Platforms
                    </label>

                    <select class="form-select" name="plat_id">
                        @for ($i = 0; $i < count($platforms); $i++)
                            <option value="{{ $platforms[$i]->id }}">{{ $platforms[$i]->platname }}</option>
                        @endfor>
                    </select>

                    @error('plat_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="banner" class="mb-2">Banner</label>
                    <input type="file" class="form-control" name="banner" value="{{ old('banner') }}" />

                    @error('banner')
                        <p class="text-red-500 text-xs
                            mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="background" class="mb-2">Background</label>
                    <input type="file" class="form-control" name="background" value="{{ old('background') }}" />

                    @error('background')
                        <p class="text-red-500 text-xs
                            mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="description" class="mb-2">
                        Description
                    </label>
                    <textarea class="form-control" name="description" rows="5" placeholder="Include tasks, requirements, salary, etc">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-secondary">
                        Create Listing
                    </button>

                    <a href="/listings" class="btn btn-secondary"> Back </a>
                </div>
            </form>
        </div>
    </div>

</x-layout>
