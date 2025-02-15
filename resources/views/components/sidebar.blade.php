<!-- resources/views/components/sidebar-navigation.blade.php -->
<div x-data="{ isOpen: false }" class="lg:col-span-3">
    <!-- Mobile Menu Button -->
    <button
        @click="isOpen = !isOpen"
        class="lg:hidden fixed top-20 right-4 z-30 p-2 rounded-lg bg-white shadow-sm border border-gray-200"
    >
        <span x-show="!isOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </span>
        <span x-show="isOpen">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </span>
    </button>
    <!-- Sidebar Container -->
    <div
        :class="isOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed lg:static top-20 inset-x-0 z-20 transform lg:transform-none transition-transform duration-200 ease-in-out h-[calc(100vh-5rem)]"
    >
        <!-- Overlay -->
        <div
            x-show="isOpen"
            @click="isOpen = false"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 lg:hidden"
            style="top: 0rem;"
        ></div>
        <!-- Sidebar Content -->
        <div class="relative mx-auto h-full lg:h-auto w-64 lg:w-auto max-w-full bg-white rounded-xl shadow-sm border border-gray-100 p-6 overflow-y-auto">
            <h2 class="text-lg font-semibold mb-6 text-gray-800">Navigation</h2>
            <nav>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('membersMasterlist') }}"
                           class="flex items-center px-4 py-2.5 {{ request()->routeIs('membersMasterlist') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }} rounded-lg transition-all duration-200">
                            Cooperative Information
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('driverMasterlist') }}"
                           class="flex items-center px-4 py-2.5 {{ request()->routeIs('driverMasterlist') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }} rounded-lg transition-all duration-200">
                            Drivers List
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('traininglist') }}"
                            class="flex items-center px-4 py-2.5 {{ request()->routeIs('traininglist') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-blue-50 hover:text-blue-600' }} rounded-lg transition-all duration-200">
                            Trainings
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('cooperativeowned') }}" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200">
                            Cooperative-Owned Units
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('individuallyowned') }}" class="flex items-center px-4 py-2.5 text-gray-600 hover:bg-blue-50 hover:text-blue-600 rounded-lg transition-all duration-200">
                            Individually-Owned Units
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>