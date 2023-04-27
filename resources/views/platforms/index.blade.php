<x-layout>
    <div class="space d-md-none"></div>
        <div class="container">
            <div class="mt-3">
            </div>
            <div class="headline">
                <h2>Platform Listing</h2>
                <div class="container">
                    <a href="/admin/platforms/create">
                    <button class="btn btn-primary">Create new platform</button></a>
                </div>
            </div>

            <div class>
                <div class="row">
                    @unless (count($platforms) == 0)
                        @foreach ($platforms as $platform)
                            <div class="col-6 col-end-4">
                                    <div class="platname">{{ $platform->platname }}
                                        <a href="{{ url('listings/?platform=/' . $platform->id) }}">
                                            <button class="btn btn-info btn-sm">Game on this platform</button></a>
                                        <a href="{{ url('users/platforms/' . $platform->id) }}">
                                            <button class="btn btn-info btn-sm">Info</button> 
                                        </a>
                                    </div>
                            </div>
                        @endforeach
                    @else
                        <p>No platform found</p>
                    @endunless
                </div>
            </div>

            <div class="mb-5 d-flex" style="justify-content: end">
                {{ $platforms->links() }}
            </div>
        </div>
    </section>
</x-layout>