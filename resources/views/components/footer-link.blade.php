@props(['href', 'id'])

@php
    $id = $id ?? Str::slug($href);
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => 'text-gray-300 hover:text-gray-400', 'id' => $id]) }}>{{ $slot }}</a>
