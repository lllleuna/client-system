@extends('layouts.layout')

@section('content')

<!-- Header Section -->
<div class="flex justify-between items-center my-3">
    <h1 class="text-2xl font-bold text-gray-900">Dashboard</h1>

</div>
<div class="container mx-auto p-2">
    <!-- Announcements Carousel -->
    <div x-data="{ currentSlide: 0, slides: [
        'bg-red-500',
        'bg-green-500',
        'bg-blue-500',
        'bg-yellow-500',
        'bg-purple-500'
    ] }" class="relative w-full overflow-hidden rounded-lg shadow-lg">
    
    <!-- Slides Container -->
    <div class="relative flex transition-transform duration-500 ease-in-out" 
         :style="'transform: translateX(-' + (currentSlide * 100) + '%); width: ' + slides.length * 100 + '%'">

        <template x-for="(slide, index) in slides" :key="index">
            <div :class="slide" class="w-full h-64 flex-shrink-0 flex items-center justify-center text-white text-2xl font-bold">
            </div>
        </template>
    </div>

    <!-- Pagination Dots -->
    <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex space-x-2">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="currentSlide = index" 
                    class="w-3 h-3 rounded-full bg-gray-300 transition-all duration-300" 
                    :class="{'bg-blue-500': currentSlide === index}">
            </button>
        </template>
    </div>
</div>

    {{-- Spacing --}}
    <div class="flex justify-between items-center my-2">
    </div>

    <!-- Grid Layout -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Application Status Overview -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="font-semibold text-lg mb-4 text-gray-800">Application Status Overview</h2>
            <ul class="space-y-2 text-gray-700">
                <li>Accreditation Status: <span class="font-bold text-blue-600">Pending</span></li>
                <li>Certificate of Good Standing: <span class="font-bold text-green-600">Approved</span></li>
            </ul>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="font-semibold text-lg mb-4 text-gray-800">Quick Actions</h2>
            <div class="space-y-2">
                <a href="{{ route('cgsrenewal') }}" class="block bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg w-full transition text-center">CGS Renewal</a>
                <a href="{{ route('training') }}" class="block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg w-full transition text-center">Request Training</a>
                <a href="{{ route('membersMasterlist') }}" class="block bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg w-full transition text-center">Update Info</a>
                <a href="{{ route('concern') }}" class="block bg-purple-500 hover:bg-purple-600 text-white px-4 py-2 rounded-lg w-full transition text-center">Related Concern</a>
            </div>
        </div>
    </div>

    <!-- Additional Information -->
    <div class="grid grid-cols-1 md:grid-cols-1 gap-6 mt-6">
        <!-- Recent Activities -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="font-semibold text-lg mb-4 text-gray-800">Recent Activities</h2>
            <ul class="divide-y divide-gray-300 text-gray-700">
                <li class="py-2">Submitted Accreditation Documents - <span class="text-gray-500">Feb 25, 2025</span></li>
                <li class="py-2">OTC Response: Additional Requirements Needed - <span class="text-gray-500">Feb 28, 2025</span></li>
            </ul>
        </div>


    </div>

    <!-- Support & FAQ -->
    <div class="bg-white shadow-md rounded-lg p-6 mt-6">
        <h2 class="font-semibold text-lg mb-4 text-gray-800">Support & FAQ</h2>
        <ul class="space-y-2">
            <li><a href="#" class="text-blue-600 hover:underline">Guidelines for Request Training & CGS Renewal</a></li>
            <li><a href="#" class="text-blue-600 hover:underline">Contact Support</a></li>
        </ul>
    </div>
</div>
@endsection