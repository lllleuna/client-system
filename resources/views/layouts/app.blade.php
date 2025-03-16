<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="OTC Website - Official Transportation Website">
    @vite('resources/css/app.css')
    @vite('resources/js/modal.js')
    @vite('resources/js/address-dropdown.js')
    <title>@yield('title', 'OTC Website')</title>
</head>
<body class="min-h-screen bg-gray-50 font-sans antialiased">
    <!-- Navigation Bar -->
    <nav class="sticky top-0 z-50 bg-gray-800 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo -->
                <a href="{{ route('login') }}" class="flex items-center space-x-3">
                    <img src="{{ asset('images/otc-logo.png') }}" class="h-12 w-auto transition-transform duration-300 hover:scale-105" alt="OTC Logo" />
                </a>

                <!-- Navigation Links -->
                <div class="flex space-x-6">
                    <a href="{{ route('login') }}" class="nav-link {{ request()->routeIs('login') ? 'text-blue-400' : 'text-white' }}">Home</a>
                    <a href="{{ route('about') }}" class="nav-link {{ request()->routeIs('about') ? 'text-blue-400' : 'text-white' }}">About</a>
                    <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services') ? 'text-blue-400' : 'text-white' }}">Services</a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'text-blue-400' : 'text-white' }}">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div>
                    <h3 class="text-lg font-semibold mb-4">About OTC</h3>
                    <p class="text-gray-300">Providing efficient transportation solutions for a better tomorrow.</p>
                </div>
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contact Us</h3>
                    <ul class="space-y-2 text-gray-300">
                        <li>Email: official@otc.gov.ph</li>
                        <li>Phone: 09989461736 / 09772111310</li>
                        <li>Address: 5th Floor Ben-Lor Bldg., Brgy. Paligsahan, 1184 Quezon Avenue, Quezon City 1103</li>
                    </ul>
                </div>
            </div>
            <div class="mt-8 pt-8 border-t border-gray-700 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} OTC. All rights reserved.</p>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <style>
        .nav-link {
            text-decoration: none;
            font-size: 1rem;
            font-weight: 500;
            transition: color 0.3s ease-in-out;
        }

        .nav-link:hover {
            color: #60a5fa;
        }
    </style>
</body>
</html>
