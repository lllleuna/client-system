<button {{ $attributes->merge(['class' => 'my-1 px-5 py-1 text-white bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-md text-center ', 'type' => 'submit'])}}>
    {{ $slot }}
</button>