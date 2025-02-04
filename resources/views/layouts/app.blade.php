<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/modal.js')
    @vite('resources/js/address-dropdown.js')
    <title>@yield('title', 'OTC Website')</title>
</head>
<body class="font-sans">

    {{-- Navigation Bar --}}
    <nav class="border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-row items-center mx-auto p-1">
            <a href="{{ route('login') }}" class="flex mr-10 items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/dotr.svg') }}" class="h-10" alt="DOTr Logo" />
            </a>
            <div class="items-center mr-5 justify-between w-full" id="navbar-cta">
                <ul class="flex flex-col font-medium p-4 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 dark:border-gray-700">
                    <li>
                        <a href="{{ route('login') }}" class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('about') }}" class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700">About</a>
                    </li>
                    <li>
                        <a href="{{ route('services') }}" class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700">Services</a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 dark:text-white dark:hover:bg-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="container mx-auto p-4">
        @yield('content')
    </div>

</body>
</html>
