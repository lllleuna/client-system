{{-- 
    resources/views/dashboard/index.blade.php
    
    Backend Dev Notes:
    - Create DashboardController to handle data aggregation
    - Implement proper authorization middleware
    - Set up activity logging for user actions
    - Consider caching for performance optimization
--}}

@include('prompt')

@extends('layouts.layout')

@section('content')
{{-- 
    Backend: Required Variables
    $user               - Current authenticated user
    $announcements      - Collection of active announcements
    $applicationStatus  - Current application status object
    $recentActivities  - Collection of recent activities
    $quickActions      - Array of enabled quick actions
--}}

<!-- Header Section with Welcome Message -->
<div class="flex justify-between items-center my-6 px-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
        <p class="text-gray-600 mt-1">Welcome back, {{ $user->name ?? 'Cooperative Chairperson' }}</p>
    </div>
    <div class="text-sm text-gray-500">
        Last Login: {{ $user->last_login ?? 'First time login' }} 
        {{-- And/Or MM/DD/YYYY HH:MM:SS --}}
    </div>
</div>

<div class="container mx-auto px-6">
    <!-- Enhanced Announcements Carousel -->
    <div x-data="{ 
        currentSlide: 0, 
        {{-- announcements: {{ json_encode($announcements ?? [ --}}
            ['title' => 'Welcome to OTC Portal', 'content' => 'Manage your cooperative efficiently', 'color' => 'bg-blue-500'],
            ['title' => 'New Guidelines Released', 'content' => 'Check the latest updates', 'color' => 'bg-green-500'],
            ['title' => 'Upcoming Training', 'content' => 'Register now for next month's session', 'color' => 'bg-purple-500']
        ]) }}
    }" 
    class="relative w-full overflow-hidden rounded-xl shadow-lg mb-8">
        
        <!-- Slides Container -->
        <div class="relative flex transition-transform duration-500 ease-in-out" 
             :style="'transform: translateX(-' + (currentSlide * 100) + '%); width: ' + announcements.length * 100 + '%'">
            <template x-for="(announcement, index) in announcements" :key="index">
                <div :class="announcement.color" 
                     class="w-full h-72 flex-shrink-0 flex flex-col items-center justify-center text-white p-8">
                    <h2 x-text="announcement.title" class="text-3xl font-bold mb-4"></h2>
                    <p x-text="announcement.content" class="text-xl text-center"></p>
                </div>
            </template>
        </div>

        <!-- Enhanced Pagination Dots -->
        <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 flex space-x-3">
            <template x-for="(_, index) in announcements" :key="index">
                <button @click="currentSlide = index" 
                        class="w-4 h-4 rounded-full border-2 border-white transition-all duration-300" 
                        :class="{'bg-white': currentSlide === index, 'bg-opacity-50': currentSlide !== index}">
                </button>
            </template>
        </div>
    </div>

    <!-- Status Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        {{-- Backend: Replace with actual status counts --}}
        @php
            $statusCards = [
                ['title' => 'Training Status', 'value' => $accreditationStatus ?? 'None', 'color' => 'blue'],
                ['title' => 'CGS Status', 'value' => $cgsStatus ?? 'Active (Until MM/DD/YYYY)', 'color' => 'green'],
                ['title' => 'Active Members', 'value' => $memberCount ?? '150', 'color' => 'purple'],
                ['title' => 'Pending Tasks', 'value' => $pendingTasks ?? '0', 'color' => 'yellow']
            ];
        @endphp

        @foreach($statusCards as $card)
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                <h3 class="text-gray-500 text-sm font-medium">{{ $card['title'] }}</h3>
                <p class="text-2xl font-bold text-{{ $card['color'] }}-600 mt-2">{{ $card['value'] }}</p>
            </div>
        @endforeach
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Quick Actions Panel -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                <h2 class="font-bold text-xl mb-6 text-gray-800">Quick Actions</h2>
                <div class="space-y-3">
                    @php
                        $actions = [
                            ['route' => 'cgsrenewal', 'text' => 'CGS Renewal', 'color' => 'green'],
                            ['route' => 'training', 'text' => 'Request Training', 'color' => 'blue'],
                            ['route' => 'membersMasterlist', 'text' => 'Update Info', 'color' => 'yellow'],
                            ['route' => 'concern', 'text' => 'Related Concern', 'color' => 'purple']
                        ];
                
                        $disableFirstThree = !Auth::check() || Auth::user()->accreditation_status !== 'active';
                    @endphp
                
                    @foreach($actions as $index => $action)
                        @if ($index < 2 && $disableFirstThree)
                            <a href="#" 
                               class="flex items-center justify-between p-4 rounded-lg bg-gray-200 hover:bg-gray-300 transition-colors disabled"
                               onclick="event.preventDefault();" title="Accreditation number is required.">
                                <span class="font-medium text-gray-500">{{ $action['text'] }}</span>
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @else
                            <a href="{{ route($action['route']) }}" 
                               class="flex items-center justify-between p-4 rounded-lg bg-{{ $action['color'] }}-50 hover:bg-{{ $action['color'] }}-100 transition-colors">
                                <span class="font-medium text-{{ $action['color'] }}-700">{{ $action['text'] }}</span>
                                <svg class="w-5 h-5 text-{{ $action['color'] }}-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        @endif
                    @endforeach
                </div>
                
                <style>
                    .disabled {
                        pointer-events: none;
                        opacity: 0.6;
                        cursor: default;
                    }
                </style>
            </div>
        </div>

        <!-- Recent Activities and Support Section -->
        <div class="lg:col-span-2">
            <!-- Recent Activities -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 mb-8">
                <h2 class="font-bold text-xl mb-6 text-gray-800">Recent Activities</h2>
                <div class="space-y-4">
                    {{-- Backend: Loop through $recentActivities --}}
                    @forelse($recentActivities ?? [] as $activity)
                        <div class="flex items-center space-x-4 p-4 rounded-lg bg-gray-50">
                            <div class="flex-shrink-0">
                                <span class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </span>
                            </div>
                            <div class="flex-1">
                                <p class="text-gray-800">{{ $activity->description ?? 'Activity Description' }}</p>
                                <p class="text-sm text-gray-500">{{ $activity->created_at ?? 'Timestamp' }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-gray-500 text-center py-4">No recent activities</p>
                    @endforelse
                </div>
            </div>

            <!-- Support & FAQ -->
            <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6">
                <h2 class="font-bold text-xl mb-6 text-gray-800">Support & FAQ</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Backend: Replace with actual support links and FAQs --}}
                    @php
                        $supportLinks = [
                            ['title' => 'Guidelines for Training', 'url' => '#', 'icon' => 'book'],
                            ['title' => 'Contact Support', 'url' => '#', 'icon' => 'phone'],
                            ['title' => 'FAQ', 'url' => '#', 'icon' => 'question'],
                            ['title' => 'Documentation', 'url' => '#', 'icon' => 'document']
                        ];
                    @endphp

                    @foreach($supportLinks as $link)
                        <a href="{{ $link['url'] }}" 
                           class="flex items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                            <span class="text-blue-600 hover:text-blue-700">{{ $link['title'] }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



{{-- 
    Backend Implementation Notes:
    
    1. Required Controllers:
    - DashboardController for main view
    - AnnouncementController for carousel data
    - ActivityController for recent activities
    
    2. Models Needed:
    - Announcement
    - Activity
    - Status (for different status types)
    - QuickAction
    
    3. Suggested Routes:
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    4. Data Structure:
    - Use View Composers for repeated data
    - Consider caching announcements
    - Implement proper pagination for activities
    
    5. Performance Tips:
    - Cache dashboard stats
    - Eager load relationships
    - Use database indexes
--}}
