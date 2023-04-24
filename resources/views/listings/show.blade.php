<x-layout>
    <div class="product-header highlights-container top-banner">
        <div class="hero-banner d-none d-sm-inline-block">
            <img class="w-100"
                src="{{ $listing->background ? asset('storage/' . $listing->background) : asset('/images/no-banner.jpg') }}"
                alt="">
        </div>
    </div>

    <div style="height: 46px"></div>

    <div class="main-content">
        <div style="height: 150px" class="d-none d-lg-inline-block"></div>
        <div class="panel-container">
            <div class="banner-sm d-sm-none">
                <img class="w-100"
                    src="{{ $listing->banner ? asset('storage/' . $listing->banner) : asset('/images/no-image.jpg') }}"
                    alt="">
            </div>

            <div class="container">
                <div class="row position-relative mb-3" style="justify-content:space-between">
                    <div class="banner d-none d-sm-block col-12 col-lg-6">
                        <img class="w-100"
                            src="{{ $listing->banner ? asset('storage/' . $listing->banner) : asset('/images/no-image.jpg') }}"
                            alt="">
                    </div>

                    <div class="panel-content col-12 col-lg-6">
                        <div class="text mb-3">
                            <span class="banner-title">{{ $listing->title }}</span>
                            <div class="price-tag">
                                <span class="price">$ {{ $listing->price }}</span>
                            </div>
                        </div>

                        <div class="action">
                            <div class="detail">
                                <h2>About the game</h2>
                                <div class="specifics mb-3">
                                    <ul>
                                        <li>
                                            <span class="title">Developer:</span>
                                            <a href="#">Naughty Dog LLC</a>
                                        </li>
                                        <li>
                                            <span class="title">Publisher:</span>
                                            <a href="#">PlayStation PC LLC</a>
                                        </li>
                                        <li>
                                            <span class="title">Release date:</span>
                                            <span style="color: #999999">28 March 2023</span>
                                        </li>
                                        <li>
                                            <span class="title mb-2">Genre:</span>
                                            <x-listing-tags :tagsCsv="$listing->tags" />
                                        </li>

                                        <li>
                                            <span class="title">Platforms:</span>
                                            <a href="/listings/?platform={{ $listing->platform->id }}" class="tag">
                                                {{ $listing->platform->platname }}
                                            </a>

                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="panel-button d-flex">
                                <form action="{{ route('users.store') }}" method="POST" class="me-2">
                                    @csrf
                                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                    <button type="submit" class="btn">
                                        <img src="/icon/icon-cart-white.svg" alt="">
                                    </button>
                                </form>

                                <form action="{{ route('users.buyNow') }}" method="POST" class="me-2">
                                    @csrf
                                    <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                                    <button type="submit" class="btn btn-secondary d-inline-block">
                                        Buy now
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="description pt-4 mb-4">
                    <div class="title">
                        <h3>Description</h3>
                    </div>
                    <div class="content">
                        <p>{{ $listing->description }}</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</x-layout>
