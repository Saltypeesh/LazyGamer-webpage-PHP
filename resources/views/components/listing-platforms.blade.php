@props(['platformsCsv'])

@php
    $platforms = explode(',', $platformsCsv);
@endphp

@foreach ($platforms as $platform)
    <a href="/listings/?platform={{ $platform }}" class="tag">{{ $platform }}</a>
@endforeach
