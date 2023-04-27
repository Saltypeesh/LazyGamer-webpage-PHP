@props(['listing'])
<div class="trending-item pb-4">
    <div class="item-image">
        <a href="/listings/{{ $listing->id }}">
            <img src="{{ $listing->banner ? asset('storage/' . $listing->banner) : asset('/images/no-image.jpg') }}"
                class="d-inline-block w-100">
        </a>
    </div>

    <div class="information">
        <div class="name">
            <a href="/listings/{{ $listing->id }}"><span class="title">{{ $listing->title }}</span></a>
        </div>

        <div class="price">$ {{ $listing->price }}</div>
    </div>
</div>
