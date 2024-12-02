<button {{ $attributes->merge(['class' => 'my-1 px-5 py-1 rounded bg-blue-900 text-white hover:bg-blue-700 focus:outline-none transition-colors', 'type' => 'submit'])}}>
    {{ $slot }}
</button>