<button {{ $attributes->merge(['class' => 'my-1 px-5 py-1 text-red-900 bg-white hover:bg-gray-300 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-md text-center'])}} >

    {{ $slot }}
</button>