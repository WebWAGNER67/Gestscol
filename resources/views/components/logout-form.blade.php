<form method="post" action="{{ route('logout') }}" {{ $attributes->merge(['class' => 'w-full ']) }}>
@csrf

<div class="relative">
    <a :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"  {{ $attributes->merge(['class' => 'block w-full h-full md:text-white dark:md:text-white dark:text-white cursor-pointer hover:bg-black dark:hover:bg-white dar:hover:bg-opacity-20 hover:bg-opacity-20 dark:hover:bg-opacity-40 p-3 rounded-xl']) }} >{{ $slot }}</a>
</div>

</form>
