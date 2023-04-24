@props(['tagsCsv'])

@php
    $tags = explode(',', $tagsCsv);
@endphp

@foreach ($tags as $tag)
    <a href="/listings/?tag={{ $tag }}" class="tag">{{ $tag }}</a>
@endforeach
