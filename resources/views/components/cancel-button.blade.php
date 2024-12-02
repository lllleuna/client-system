<button {{ $attributes->merge(['class' => 'my-1 px-5 py-1 rounded text-gray-800 hover:bg-gray-200 focus:outline-none transition-colors'])}} >

    {{ $slot }}
</button>