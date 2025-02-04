@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="m-auto flex flex-row ">
        <div class="basis-1/2 mx-2 pl-20 place-content-center">
            <h1 class="mb-5 text-4xl font-bold uppercase">Office of Transportation Cooperatives <br> National Capital Region</h1>
            <p class="uppercase text-2xl mb-10 italic">"Innovation towards modernization"</p>
            <div class="flex items-center">
                <button onclick="openModal('modallog')" type="button" class="text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-md px-4 py-2">LOG IN</button>
                <button onclick="openModal('modalCreate')" type="button" class="text-white mx-5 bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-md px-4 py-2">SIGN UP</button>
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
@endsection
