@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'bg-transparent focus-visible:outline-none py-2 px-4 border rounded-xl placeholder:text-gray-300 text-white focus-visible:border-blue-700']) !!}>
