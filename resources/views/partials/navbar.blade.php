<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">
    <nav x-data="{ mobileMenuOpen: false }" class="bg-gray-900 text-white py-4 px-6">
        <!-- Desktop Navigation -->
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-center">
                <!-- Left Section: Logo -->
                <div class="flex items-center space-x-3">
                    <a href="{{ url('/dash') }}" class="flex items-center space-x-3">
                        <img src="{{ asset('images/otc-logo.png') }}" class="h-12 w-auto transition-transform duration-300 hover:scale-105" alt="OTC Logo" />
                    </a>
                    <span class="text-lg font-semibold hidden md:block">Office of Transportation Cooperatives - Client Portal</span>
                    <span class="text-lg font-semibold md:hidden">OTC Portal</span>
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-white focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path x-show="!mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                            <path x-show="mobileMenuOpen" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <!-- Desktop Menu Items -->
                <div class="hidden md:flex items-center space-x-6">
                    <!-- Center Section: Navigation Links -->
                    <div class="flex space-x-6">
                        <a href="{{ url('/dash') }}" class="hover:text-gray-300 transition">Dashboard</a>
                        <a href="{{ route('infoupdate') }}" class="hover:text-gray-300 transition">My Information</a>
                        <!-- Services Dropdown -->
                        <div class="relative" x-data="{ open: false }">
                            @if (Auth::check() && Auth::user()->accreditation_status === 'Active')
                                <button @click="open = !open" class="hover:text-gray-300 transition flex items-center">
                                    Services ▼
                                </button>
                                <div
                                    x-show="open"
                                    @click.away="open = false"
                                    class="absolute left-0 mt-2 w-48 bg-white text-black rounded-lg shadow-lg z-50"
                                >
                                    <a href="{{ route('cgsrenewal') }}" class="block px-4 py-2 hover:bg-gray-200">Certificate of Good Standing</a>
                                    <a href="{{ route('training') }}" class="block px-4 py-2 hover:bg-gray-200">Training & Seminars</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Right Section: Actions -->
                    <div class="flex items-center space-x-6">
                        {{-- Send Message --}}
                        {{-- <x-send-message/> --}}
                        {{-- Bell Notification --}}
                        {{-- <x-bell-notification/> --}}
                        {{-- Profile Coop --}}
                        <x-profile-coop />
                    </div>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-200"
                 x-transition:enter-start="opacity-0 transform -translate-y-2"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-150"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-2"
                 class="md:hidden">
                <div class="pt-4 pb-3 space-y-3">
                    <a href="{{ url('/dash') }}" class="block hover:bg-gray-700 px-3 py-2 rounded-md">Dashboard</a>
                    <a href="{{ route('infoupdate') }}" class="block hover:bg-gray-700 px-3 py-2 rounded-md">My Information</a>
                    
                    <!-- Mobile Services Dropdown -->
                    <div x-data="{ servicesOpen: false }">
                        @if (Auth::check() && Auth::user()->accreditation_status === 'Active')
                            <button @click="servicesOpen = !servicesOpen" class="w-full text-left hover:bg-gray-700 px-3 py-2 rounded-md">
                                Services ▼
                            </button>
                            <div x-show="servicesOpen" class="pl-6 space-y-2">
                                <a href="{{ route('cgsrenewal') }}" class="block hover:bg-gray-700 px-3 py-2 rounded-md">Certificate of Good Standing</a>
                                <a href="{{ route('training') }}" class="block hover:bg-gray-700 px-3 py-2 rounded-md">Training & Seminars</a>
                            </div>
                        @endif
                    </div>

                    <!-- Mobile Action Items -->
                    <div class="border-t border-gray-700 pt-4 space-y-3">
                        <div class="px-3">
                            {{-- Send Message --}}
                            <x-send-message/>
                        </div>
                        <div class="px-3">
                            {{-- Bell Notification --}}
                            <x-bell-notification/>
                        </div>
                        <div class="px-3">
                            {{-- Profile Coop --}}
                            <x-profile-coop />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</body>
</html>