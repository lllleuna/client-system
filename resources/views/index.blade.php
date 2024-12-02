<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/modal.js')
    @vite('resources/js/address-dropdown.js')
    <title>Document</title>
</head>
<body class="font-sans">


    <nav class="border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-xl flex flex-row items-center mx-auto p-1">
            <a href="" class="flex mr-10 items-center space-x-3 rtl:space-x-reverse">
                <img src="{{ asset('images/dotr.svg') }}" class="h-10" alt="DOTr Logo" />
            </a>
            <div class="items-center mr-5 justify-between w-full" id="navbar-cta">
                <ul class="flex flex-col  font-medium p-4  mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8  md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800  dark:border-gray-700">
                    <li>
                        <a href="#" class="block py-2 px-3 md:p-0 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:dark:text-blue-500" aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">About</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Services</a>
                    </li>
                    <li>
                        <a href="#" class="block py-2 px-3 md:p-0 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
      
{{-- Home page content --}}
    <div class="m-auto flex flex-row ">
        <div class="basis-1/2 mx-2 pl-20 place-content-center">
            <h1 class="mb-5 text-4xl font-bold uppercase">Office of transportation cooperatives <br>
            National capital region</h1>
            <p class="uppercase text-2xl mb-10 italic">"Innovation towards modernization"</p>
            <div class="flex items-center">
                <button onclick="openModal('modallog')" type="button" class="text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-md px-4 py-2 text-center ">LOG IN</button>
                <button onclick="openModal('modalCreate')" type="button" class="text-white mx-5 bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-md px-4 py-2 text-center ">SIGN UP</button>
            </div>
        </div>
        <div class="basis-1/2 mx-2">
            <img src="{{ asset('images/otc-logo.png') }}" alt="">
        </div>
    </div>

    {{-- User Log in --}}
    <x-modal id="modallog"
        class="{{ $errors->hasAny(['email', 'password']) ? 'modal-error' : 'hidden' }}">
        <x-slot:closebtnSlot>
            <x-modal-close-button onclick="closeModal('modallog')" />
        </x-slot:closebtnSlot>
        @include('auth.login')
    </x-modal>

    {{-- Create User Account --}}
    <x-modal id="modalCreate"
        class="{{ $errors->hasAny(['chair_fname', 'chair_lname', 'password_confirmation']) ? 'modal-error' : 'hidden' }}">
        <x-slot:closebtnSlot>
            <x-modal-close-button onclick="closeModal('modalCreate')" />
        </x-slot:closebtnSlot>
        @include('users.create')
    </x-modal>
    


</body>
</html>