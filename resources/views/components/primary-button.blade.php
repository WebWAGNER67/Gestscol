<button {{ $attributes->merge(['type' => 'submit', 'class' => 'w-full bg-blue-700 hover:bg-blue-500 rounded-xl p-2 text-center text-white uppercase font-bold']) }}>
    {{ $slot }}
</button>
