{{-- Extend the main layout to include navigation --}}
@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-50">
    
    {{-- 🔹 Navigation Component (Progress Bar) --}}
    {{-- Expecting $currentStep to be passed from the backend --}}
    <x-form-progress :currentStep="$currentStep ?? 1" />

    {{-- 🔹 Main Form Wrapper --}}
    <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-md border border-gray-200">
            
            {{-- 🔹 Form Header --}}
            <div class="border-b border-gray-200 px-6 py-4">
                <h1 class="text-xl font-semibold text-gray-900">
                    2024 – OTC Annual Report Form
                </h1>
                <p class="text-sm text-gray-600 mt-1">
                    Period Covered: CY 2023
                </p>
            </div>

            {{-- 🔹 Form Content --}}
            <div class="p-6">
                {{-- Placeholder for different form steps --}}
                @yield('form-content')
            </div>
        </div>
    </div>
</div>
@endsection
