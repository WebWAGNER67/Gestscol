<x-home-layout>
    <div class="flex flex-col gap-3">
        <h2 class="text-4xl font-semibold text-white">{{ $content }}</h2>
        <div class="gap-6 p-3 bg-white dark:bg-black bg-opacity-20 dark:bg-opacity-20 rounded-xl">
            @include('layouts.trombilist')
        </div>
    </div>
</x-home-layout>
