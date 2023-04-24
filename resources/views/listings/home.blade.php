<x-layout>
    @include('partials._hero')
    @include('partials._search')

    <section class="trending">
        <div class="container">
            <div class="headline">
                <h2>Trending</h2>
                <a href="/listings" class="btn btn-secondary">View All</a>
            </div>

            @if (count($listings) != 0)
                <div class="owl-carousel owl-theme d-sm-none d-block">
                    @for ($i = 0; $i < 6; $i++)
                        <x-listing-card :listing="$listings[$i]" />
                    @endfor
                </div>

                <div class="d-none d-sm-inline-block">
                    <div class="row">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="col-6 col-md-4">
                                <x-listing-card :listing="$listings[$i]" />
                            </div>
                        @endfor
                    </div>
                </div>
            @else
                <div style="height: 300px">No Listing found123</div>
            @endif

        </div>
    </section>

    @include('partials._trust-panel')

    <section class="trending">
        <div class="container">
            <div class="headline">
                <h2>Trending</h2>
                <a href="/listings" class="btn btn-secondary">View All</a>
            </div>

            @if (count($listings) != 0)

                <div class="owl-carousel owl-theme d-sm-none d-block">
                    @for ($i = 0; $i < 6; $i++)
                        <x-listing-card :listing="$listings[$i]" />
                    @endfor
                </div>

                <div class="d-none d-sm-inline-block">
                    <div class="row">
                        @for ($i = 0; $i < 6; $i++)
                            <div class="col-6 col-md-4">
                                <x-listing-card :listing="$listings[$i]" />
                            </div>
                        @endfor
                    </div>
                </div>
            @else
                <div style="height: 300px">No Listing found</div>
            @endif

        </div>
    </section>
</x-layout>
