@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="m-auto flex flex-row ">
        <div class="basis-1/2 mx-2 pl-20 place-content-center">
            @if (session('success'))
                <div id="success-message" class="bg-green-200 text-green-800 p-3 rounded">
                    {{ session('success') }}
                </div>

                <script>
                    setTimeout(() => {
                        document.getElementById('success-message').style.display = 'none';
                    }, 5000); // Hides the message after 5 seconds
                </script>
            @endif
            <h1 class="mb-5 text-4xl font-bold uppercase">Office of Transportation Cooperatives <br> National Capital Region</h1>
            <p class="uppercase text-2xl mb-10 italic">"Innovation towards modernization"</p>
            <div class="flex items-center">
                <button onclick="openModal('modallog')" type="button" class="text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-md px-4 py-2">LOG IN</button>
                <a href="/users/create" class="text-white mx-5 bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-md px-4 py-2">SIGN UP</a>
            </div>
        </div>
        <div class="basis-1/2 mx-2">
            <img src="{{ asset('images/otc-logo.png') }}" alt="">
        </div>
    </div>

    {{-- User Log in --}}
    <x-modal id="modallog"
        class="{{ $errors->login->any() ? 'modal-error' : 'hidden' }}">
        <x-slot:closebtnSlot>
            <x-modal-close-button onclick="closeModal('modallog')" />
        </x-slot:closebtnSlot>
        @include('auth.login')
    </x-modal>

    {{-- Add JavaScript to handle modal display on validation errors --}}
    @if($errors->login->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                openModal('modallog');
            });
        </script>
    @endif

@endsection