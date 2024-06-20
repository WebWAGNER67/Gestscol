@props(['active', 'href'])

@php

$classes = ($active ?? false)
            ? 'flex w-full gap-3 text-white bg-black dark:bg-white dark:bg-opacity-20 cursor-pointer bg-opacity-20 rounded-xl'
            : 'flex w-full gap-3 text-white cursor-pointer hover:bg-black dark:hover:bg-white hover:bg-opacity-20 dark:hover:bg-opacity-20 rounded-xl';
@endphp

<li {{ $attributes->merge(['class' => $classes]) }}>
    <a {{ $attributes->merge(['href' => $href]) }} class="flex w-full gap-3 p-3">
        {{ $slot }}
    </a>
</li>
