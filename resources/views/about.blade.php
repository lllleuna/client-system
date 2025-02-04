@extends('layouts.app')

@section('title', 'About Us')

@section('content')
    <div class="max-w-6xl mx-auto mt-10 px-6">
        <h1 class="text-4xl font-bold text-center mb-4">About Us</h1>
        <p class="text-gray-600 text-center mb-10">
            Welcome to the Office of Transportation Cooperative's Client Portal, 
            a dedicated platform for cooperative groups to manage their information and access resources.
        </p>

        <div class="flex flex-col md:flex-row items-center justify-between gap-8">
            <!-- Left Content -->
            <div class="md:w-1/2">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                    Empowering Transportation Cooperatives
                </h2>
                <p class="text-gray-600 leading-relaxed">
                    This portal is managed by University of Makati students, in partnership with 
                    the Office of the Transport Cooperative. We provide digital solutions to enhance 
                    the efficiency and effectiveness of transportation cooperatives in the Philippines.
                </p>
                <p class="text-gray-600 mt-4">
                    For more information about our organization, visit the 
                    <a href="https://otc.gov.ph/" class="text-blue-600 underline">official website</a>.
                </p>
            </div>

            <!-- Right Image Placeholder -->
            <div class="md:w-1/2">
                <div class="w-full h-64 bg-gray-300 flex items-center justify-center rounded-lg shadow-md">
                    <span class="text-gray-500">Image Placeholder</span>
                </div>
            </div>
        </div>
    </div>
@endsection
