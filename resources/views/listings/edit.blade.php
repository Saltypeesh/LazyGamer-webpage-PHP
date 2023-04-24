<x-layout>
    <div class="listing-form">
        <div class="container">
            <div class="header-manage pt-3">
                <h2>Edit a Game Listing</h2>
                <p class="mb-4">Edit a game listing</p>
            </div>

            <form class="pb-3" method="POST" action="{{ route('admin.update', $listing->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-2">
                    <label for="title" class="mb-2">Title</label>
                    <input type="text" class="form-control" name="title" value="{{ $listing->title }}" />

                    @error('title')
                        <p class="text-red-500 text-xs
                            mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="price" class="mb-2">Price</label>
                    <input type="number" step="0.01" min="0.99" max="199.99" class="form-control"
                        name="price" value="{{ $listing->price }}" />

                    @error('price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="tags[]" class="mb-2">Tags</label>

                    @php
                        $tags = explode(',', $listing->tags);
                        $option = ['Adventure', 'Action', "Beat'em-all", 'Early-Access', 'FPS', 'Multiplayer', 'Indies', 'Online', 'RPG', 'Sport', 'Simulation', 'Strategy', 'Single-player', 'Other'];
                    @endphp

                    <select class="js-example-basic-multiple form-select" name="tags[]" multiple="multiple">
                        @for ($i = 0; $i < count($option); $i++)
                            {{ $selected = false }}

                            @for ($j = 0; $j < count($tags); $j++)
                                @if ($option[$i] == $tags[$j])
                                    <option value="{{ $option[$i] }}" selected>{{ $option[$i] }}</option>
                                    {{ $selected = true }}
                                @endif
                            @endfor

                            @if (!$selected)
                                <option value="{{ $option[$i] }}">{{ $option[$i] }}</option>
                            @endif
                        @endfor
                    </select>

                    @error('tags')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="plat_id" class="mb-2">Platforms</label>

                    <select class="form-select" name="plat_id">
                        @for ($i = 0; $i < count($platforms); $i++)
                            <option value="{{ $platforms[$i]->id }}"
                                {{ $platforms[$i]->id == $listing->plat_id ? 'selected' : '' }}>
                                {{ $platforms[$i]->platname }}</option>
                        @endfor
                    </select>

                    @error('platforms')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="banner" class="mb-2">Banner</label>
                    <div class="edit_banner">
                        <img class="w-100 mb-3" style="border-radius: 20px"
                            src="{{ $listing->banner ? asset('storage/' . $listing->banner) : asset('/images/no-image.jpg') }}"
                            alt="">
                    </div>
                    <input type="file" class="form-control" name="banner" value="{{ old('banner') }}" />

                    @error('banner')
                        <p class="text-red-500 text-xs
                            mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-2">
                    <label for="background" class="mb-2">Background</label>

                    <div class="edit_background">
                        <img class="w-100 mb-3" style="border-radius: 20px"
                            src="{{ $listing->background ? asset('storage/' . $listing->background) : asset('/images/no-banner.jpg') }}"
                            alt="">
                    </div>
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
                    <textarea class="form-control" name="description" rows="5" placeholder="Include tasks, requirements, salary, etc">{{ $listing->description }}</textarea>

                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-secondary">
                        Update Listing
                    </button>

                    <a href="/listings" class="btn btn-secondary"> Back </a>
                </div>
            </form>
        </div>
    </div>

</x-layout>
