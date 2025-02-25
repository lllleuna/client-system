@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="m-auto flex flex-row ">
        <div class="basis-1/2 mx-2 pl-20 place-content-center">
            <h1 class="mb-5 text-4xl font-bold uppercase">Office of Transportation Cooperatives <br> National Capital Region</h1>
            <p class="uppercase text-2xl mb-10 italic">"Innovation towards modernization"</p>
            <div class="flex items-center">
                <button onclick="openModal('modallog')" type="button" class="text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-md px-4 py-2">LOG IN</button>
                <button dusk="signup-btn" onclick="openModal('modalCreate')" type="button" class="text-white mx-5 bg-blue-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-md px-4 py-2">SIGN UP</button>
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

    {{-- Create User Account --}}
<x-modal id="modalCreate"
class="{{ $errors->signup->any() ? 'modal-error' : 'hidden' }}"
x-data="{ currentView: 'selection' }">
<x-slot:closebtnSlot>
    <x-modal-close-button onclick="resetModalView()" />
</x-slot:closebtnSlot>

<div id="cooperativeSelection" x-show="currentView === 'selection'" class="flex flex-col items-center">
    <h2 class="text-xl font-bold mb-6">Select Cooperative Type</h2>
    <div class="flex space-x-4">
        <button type="button" 
            onclick="showNewCooperativeForm()"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            New Cooperative
        </button>
        <button type="button" 
            onclick="showExistingCooperativeForm()"
            class="px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
            Existing Cooperative
        </button>
    </div>
</div>

<div id="existingCooperativeForm" x-show="currentView === 'existing'" class="hidden">
    <div class="mb-4">
        <button type="button" 
            onclick="goBackToSelection()"
            class="flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back
        </button>
    </div>
    
    <form action="#" method="POST">
        @csrf
        <input type="hidden" name="cooperative_type" value="existing">
        @include('users.create')
    </form>
</div>

<div id="newCooperativeForm" x-show="currentView === 'new'" class="hidden">
    <div class="mb-4">
        <button type="button" 
            onclick="goBackToSelection()"
            class="flex items-center px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Back
        </button>
    </div>

    <form action="#" method="POST">
        @csrf
        <input type="hidden" name="cooperative_type" value="new">
        @include('users.new')
    </form>
</div>

<script>
    // Initialize Alpine.js data correctly
    document.addEventListener('alpine:init', () => {
        Alpine.store('modalCreate', {
            currentView: 'selection'
        });
    });

    function showNewCooperativeForm() {
        document.getElementById('cooperativeSelection').classList.add('hidden');
        document.getElementById('newCooperativeForm').classList.remove('hidden');
        Alpine.store('modalCreate').currentView = 'new';
    }

    function showExistingCooperativeForm() {
        document.getElementById('cooperativeSelection').classList.add('hidden');
        document.getElementById('existingCooperativeForm').classList.remove('hidden');
        Alpine.store('modalCreate').currentView = 'existing';
    }

    function goBackToSelection() {
        document.getElementById('cooperativeSelection').classList.remove('hidden');
        document.getElementById('existingCooperativeForm').classList.add('hidden');
        document.getElementById('newCooperativeForm').classList.add('hidden');
        Alpine.store('modalCreate').currentView = 'selection';
    }

    function resetModalView() {
        closeModal('modalCreate');
        // Reset to selection view when closing the modal
        setTimeout(() => {
            goBackToSelection();
        }, 300); // Small timeout to ensure it happens after modal closes
    }

    // Add event listener to modal backdrop for reset
    document.addEventListener('DOMContentLoaded', () => {
        const modalBackdrop = document.querySelector('#modalCreate .modal-backdrop');
        if (modalBackdrop) {
            modalBackdrop.addEventListener('click', resetModalView);
        }
    });
</script>
</x-modal>

    {{-- Add JavaScript to handle modal display on validation errors --}}
    @if($errors->login->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                openModal('modallog');
            });
        </script>
    @endif

    @if($errors->signup->any())
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                openModal('modalCreate');
            });
        </script>
    @endif
@endsection