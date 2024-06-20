@props(['href'])

<a class="absolute top-0 w-0 h-0 p-0 overflow-hidden text-lg active:static active:w-auto active:h-auto active:overflow-visible focus:static focus:w-auto focus:h-auto focus:overflow-visible" href="{{ $href }}">
    <div class="w-full px-5 mx-auto">
        <span class="text-white">{{ $slot }}</span>
    </div>
</a>
