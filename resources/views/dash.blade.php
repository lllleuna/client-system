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
        <p class="text-gray-600 mt-1">Welcome, {{ $user->name ?? 'Cooperative Chairperson' }}</p> {{-- Backend: Replace with actual user name --}}
    </div>
    <div class="flex-row">
        <p class="text-sm text-gray-500">Last Login: {{ $user->last_login ?? 'First time login' }} </p>
        {{-- And/Or MM/DD/YYYY HH:MM:SS --}}
        <a href="/auth/mfa"><h3>Verify SMS</h3></a>
        {{-- <a href=""><h3>Authenticator Code</h3></a> --}}
    </div>
</div>

{{-- temporary success message when contact verified --}}
<x-success-notif />

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
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
        <!-- CGS Status Card with Interactive Progress Bar -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 cursor-pointer relative overflow-hidden group" 
            onclick="window.location.href='#'" 
            {{-- Attention! Namme, Pa-edit ng route na paputang CGS Renewal yung onclick="window.location.href='#'" sa taas nito.  --}}
            id="cgs-status-card">
            <!-- Hover effect overlay -->
            <div class="absolute inset-0 bg-green-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <div class="relative z-10"> <!-- Content above the overlay -->
                <div class="flex justify-between items-center">
                    <h3 class="text-gray-500 text-sm font-medium">CGS Status</h3>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full font-medium">Active</span>
                </div>
                
                <p class="text-2xl font-bold text-green-600 mt-2">{{ $cgsStatus ?? 'Valid Until 04/25/2025' }}</p>
                
                <!-- Progress Bar Section -->
                <div class="mt-4">
                    <div class="flex justify-between items-center mb-1">
                        <span class="text-xs text-gray-500">Application Window:</span>
                        <span class="text-xs font-medium text-gray-700" id="cgs-countdown">{{ $daysRemaining ?? '21' }} days remaining</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-green-600 h-3 rounded-full relative" style="width: {{ $progressPercentage ?? '65' }}%" id="cgs-progress-bar">
                            <div class="absolute right-0 top-0 h-3 w-3 bg-white border-2 border-green-600 rounded-full transform translate-x-1/2 shadow-sm"></div>
                        </div>
                    </div>
                    <div class="flex justify-between text-xs text-gray-500 mt-1">
                        <span>{{ $applicationStartDate ?? 'Apr 7, 2025' }}</span>
                        <span class="font-medium">{{ $applicationDeadline ?? 'May 12, 2025' }}</span>
                    </div>
                    <div class="mt-3 text-xs flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span class="text-gray-600">Recommended: Apply at least 2 weeks before deadline</span>
                    </div>
                </div>
                
                <!-- View Details Button -->
                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <button class="w-full py-2 bg-green-600 hover:bg-green-700 text-white rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <span>View Renewal Details</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Total Units Card with Interactive Pie Chart -->
        <div class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow p-6 cursor-pointer relative overflow-hidden group" 
            onclick="showUnitDetails()" 
            id="units-card">
            <!-- Hover effect overlay -->
            <div class="absolute inset-0 bg-purple-50 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <div class="relative z-10"> <!-- Content above the overlay -->
                <div class="flex justify-between items-center">
                    <h3 class="text-gray-500 text-sm font-medium">Total Units</h3>
                    <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded-full font-medium" id="units-change">+3 this month</span>
                </div>
                
                <p class="text-2xl font-bold text-purple-600 mt-2">{{ $memberCount ?? '150' }}</p>
                
                <!-- Pie Chart Section -->
                <div class="mt-4 flex flex-col items-center">
                    <!-- Canvas for Chart.js -->
                    <div class="w-40 h-40 relative">
                        <canvas id="unitsChart" width="160" height="160"></canvas>
                    </div>
                    
                    <!-- Interactive Legend -->
                    <div class="flex justify-center gap-6 mt-4">
                        <div class="flex items-center cursor-pointer hover:opacity-80 transition-opacity" onclick="toggleChartSegment(0)">
                            <div class="w-3 h-3 rounded-full bg-purple-500 mr-2"></div>
                            <span class="text-sm text-gray-700">Cooperative <span class="font-medium">({{ $cooperativeCount ?? '98' }})</span></span>
                        </div>
                        <div class="flex items-center cursor-pointer hover:opacity-80 transition-opacity" onclick="toggleChartSegment(1)">
                            <div class="w-3 h-3 rounded-full bg-purple-200 mr-2"></div>
                            <span class="text-sm text-gray-700">Individual <span class="font-medium">({{ $individualCount ?? '52' }})</span></span>
                        </div>
                    </div>
                </div>
                
                <!-- View Details Button -->
                <div class="mt-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <button class="w-full py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-md text-sm font-medium transition-colors duration-200 flex items-center justify-center">
                        <span>View Unit Details</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
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
                
                        $disableFirstThree = !Auth::check() || Auth::user()->accreditation_status !== 'Active';
                    @endphp
                
                    @foreach($actions as $index => $action)
                        @if ($index < 2 && $disableFirstThree)
                            <a href="#" 
                            class="flex items-center justify-between p-4 rounded-lg bg-gray-200 hover:bg-gray-300 transition-colors unauthorized-action"
                            onclick="showUnauthorizedModal(event); " title="Accreditation number is required.">
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
                        ['title' => "Citizen's Charter", 'url' => 'https://otc.gov.ph/about/citizens-charter-2/', 'icon' => 'book'],
                        ['title' => 'Terms and Conditions', 'url' => '#', 'icon' => 'phone'],
                        ['title' => 'Privacy Policy', 'url' => '#', 'icon' => 'question'],
                        ['title' => 'Contact Support', 'url' => '#', 'icon' => 'mail', 'modal' => 'contactModal'],
                    ];
                    @endphp
                   
                    @foreach($supportLinks as $link)
                        @if(isset($link['modal']))
                            <button type="button" 
                                onclick="document.getElementById('{{ $link['modal'] }}').classList.remove('hidden')"
                                class="flex items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors">
                                <span class="text-blue-600 hover:text-blue-700">{{ $link['title'] }}</span>
                            </button>
                        @else
                            <a href="{{ $link['url'] }}" 
                            class="flex items-center p-4 rounded-lg bg-gray-50 hover:bg-gray-100 transition-colors"
                            @if(str_starts_with($link['url'], 'http')) target="_blank" rel="noopener noreferrer" @endif>
                            <span class="text-blue-600 hover:text-blue-700">{{ $link['title'] }}</span>
                            </a>
                        @endif
                    @endforeach
                </div>
                
                <!-- Contact Support Modal -->
                <div id="contactModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
                    <div class="relative top-20 mx-auto p-5 border w-11/12 md:w-1/2 lg:w-1/3 shadow-lg rounded-md bg-white">
                        <div class="flex justify-between items-center border-b pb-3">
                            <h3 class="text-lg font-medium text-gray-900">Contact Information</h3>
                            <button onclick="document.getElementById('contactModal').classList.add('hidden')" class="text-gray-400 hover:text-gray-500">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </button>
                        </div>
                        
                        <div class="mt-4 space-y-3">
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span class="ml-3">
                                    <span class="font-medium block">Address:</span>
                                    5th Floor Ben-Lor Bldg., Brgy. Paligsahan, 1184 Quezon Avenue, Quezon City 1103
                                </span>
                            </div>
                            
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span class="ml-3">
                                    <span class="font-medium block">Email:</span>
                                    official@otc.gov.ph
                                </span>
                            </div>
                            
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                </svg>
                                <span class="ml-3">
                                    <span class="font-medium block">Cellphone:</span>
                                    09989461736 / 09772111310
                                </span>
                            </div>
                            
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span class="ml-3">
                                    <span class="font-medium block">Telephone:</span>
                                    (02) 8332-9315
                                </span>
                            </div>
                            
                            <div class="flex items-start">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 8l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M5 3a2 2 0 00-2 2v1c0 8.284 6.716 15 15 15h1a2 2 0 002-2v-3.28a1 1 0 00-.684-.948l-4.493-1.498a1 1 0 00-1.21.502l-1.13 2.257a11.042 11.042 0 01-5.516-5.517l2.257-1.13a1 1 0 00.502-1.21L9.228 3.683A1 1 0 008.279 3H5z" />
                                </svg>
                                <span class="ml-3">
                                    <span class="font-medium block">Facebook:</span>
                                    <a href="https://www.facebook.com/DOTR.OTC" target="_blank" rel="noopener noreferrer" 
                                       class="text-blue-600 hover:underline">
                                        https://www.facebook.com/DOTR.OTC
                                    </a>
                                </span>
                            </div>                            
                        </div>
                        
                        <div class="mt-6 flex justify-end">
                            <button onclick="document.getElementById('contactModal').classList.add('hidden')" 
                                class="px-4 py-2 bg-blue-600 text-white text-base font-medium rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showUnauthorizedModal(event) {
    event.preventDefault(); // Prevent default action

    if (shouldShowModal) {
        openModal('modalCreate');
        document.getElementById("modalCreate").classList.remove("hidden");
    } else {
        alert("Your Application for Accreditation is still on-process. Thank you for patiently waiting!");
    }
}

function closeModal(id) {
    document.getElementById(id).classList.add("hidden");
}

</script>
<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // Initialize the pie chart using Chart.js
    document.addEventListener('DOMContentLoaded', function() {
        // Pie chart setup for units
        const ctx = document.getElementById('unitsChart').getContext('2d');
        window.unitsChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Cooperative', 'Individual'],
                datasets: [{
                    data: [{{ $cooperativeCount ?? 98 }}, {{ $individualCount ?? 52 }}],
                    backgroundColor: [
                        '#8b5cf6', // purple-500
                        '#ddd6fe'  // purple-200
                    ],
                    borderColor: [
                        '#ffffff',
                        '#ffffff'
                    ],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                cutout: '65%',
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.raw || 0;
                                const total = context.dataset.data.reduce((acc, data) => acc + data, 0);
                                const percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} units (${percentage}%)`;
                            }
                        }
                    }
                },
                animation: {
                    animateScale: true,
                    animateRotate: true
                }
            }
        });
        
        // CGS progress bar animation
        animateProgressBar('cgs-progress-bar', {{ $progressPercentage ?? 65 }});
        
        // Update countdown timer every day
        updateCountdown();
    });
    
    // Function to toggle visibility of chart segments when clicking on legend
    function toggleChartSegment(index) {
        const meta = window.unitsChart.getDatasetMeta(0);
        const isHidden = meta.data[index].hidden || false;
        meta.data[index].hidden = !isHidden;
        window.unitsChart.update();
    }
    
    // Function to animate the progress bar on load
    function animateProgressBar(elementId, targetPercentage) {
        const progressBar = document.getElementById(elementId);
        let width = 0;
        const intervalTime = 10;
        const increment = targetPercentage / (1000 / intervalTime);
        
        const interval = setInterval(() => {
            if (width >= targetPercentage) {
                clearInterval(interval);
            } else {
                width += increment;
                progressBar.style.width = width + '%';
            }
        }, intervalTime);
    }
    
    // Function to update the countdown timer
    function updateCountdown() {
        // Replace with actual deadline date calculation
        const deadlineDate = new Date('2025-05-12');
        const currentDate = new Date();
        const timeRemaining = deadlineDate - currentDate;
        
        // Convert to days and round down
        const daysRemaining = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
        
        document.getElementById('cgs-countdown').textContent = 
            daysRemaining > 0 ? `${daysRemaining} days remaining` : 'Deadline reached';
            
        // Apply urgency styling if less than 7 days
        if (daysRemaining <= 7 && daysRemaining > 0) {
            document.getElementById('cgs-countdown').classList.add('text-amber-600', 'font-bold');
        } else if (daysRemaining <= 0) {
            document.getElementById('cgs-countdown').classList.add('text-red-600', 'font-bold');
        }
    }
    
    // Show unit details modal/page
    function showUnitDetails() {
        // Placeholder for navigation to details page or modal display
        window.location.href = '{{ route("units") }}';
        // Or show a modal:
        // document.getElementById('unit-details-modal').classList.remove('hidden');
    }
</script>
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
