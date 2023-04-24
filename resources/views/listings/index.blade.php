<x-layout>
    <div class="space d-md-none"></div>
    @include('partials._search')

    <section class="trending">
        <div class="container">
            <div class="headline">
                <h2>Game Listing</h2>
            </div>

            <div class="d-inline-block w-100" style="min-height: 435px;">
                <div class="row">
                    @unless (count($listings) == 0)
                        @foreach ($listings as $listing)
                            <div class="col-6 col-md-4">
                                <x-listing-card :listing="$listing" />
                            </div>
                        @endforeach
                    @else
                        <p>No listing found</p>
                    @endunless
                </div>
            </div>

            <div class="mb-5 d-flex" style="justify-content: end">
                {{ $listings->links() }}
            </div>
        </div>
    </section>
</x-layout>
