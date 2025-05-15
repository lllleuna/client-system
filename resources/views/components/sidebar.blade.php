<!-- resources/views/components/sidebar-navigation.blade.php -->
<div x-data="{ 
    isOpen: false,
    menus: {
        cooperative: {{ request()->routeIs('membersMasterlist', 'traininglist', 'cooperativeowned', 'individuallyowned') ? 'true' : 'false' }},
        operations: {{ request()->routeIs('generalinfo', 'membership', 'employment', 'units', 'franchise') ? 'true' : 'false' }},
        governance: {{ request()->routeIs('officers') ? 'true' : 'false' }},
        financial: {{ request()->routeIs('finances', 'grants', 'loans', 'businesses') ? 'true' : 'false' }},
        development: {{ request()->routeIs('trainings', 'scholarships', 'cetos', 'awards') ? 'true' : 'false' }}
    }
}" class="lg:col-span-3">
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
        <div class="relative mx-auto h-full lg:h-auto w-72 lg:w-auto max-w-full bg-white rounded-xl shadow-sm border border-gray-100 p-4 overflow-y-auto">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 px-2">Navigation</h2>
            <nav class="space-y-1">
                <!-- Cooperative Information Menu -->
                <div class="mb-1">
                    <button @click="menus.cooperative = !menus.cooperative"
                        class="w-full px-4 py-2.5 text-left rounded-lg flex items-center justify-between hover:bg-gray-50 transition-colors"
                        :class="menus.cooperative ? 'bg-gray-50' : ''">
                        <span class="font-medium text-gray-700">Cooperative Information</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            :class="menus.cooperative ? 'transform rotate-90' : ''"
                            class="w-5 h-5 transition-transform"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <div x-show="menus.cooperative" class="ml-4 space-y-1 mt-1">
                        <a href="{{ route('membersMasterlist') }}"
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('membersMasterlist') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Members Masterlist
                        </a>
                        {{-- <a href="{{ route('traininglist') }}"
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('traininglist') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Training Attendees
                        </a> --}}
                        <a href="{{ route('cooperativeowned') }}"
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('cooperativeowned') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Cooperative-Owned Units
                        </a>
                        <a href="{{ route('individuallyowned') }}"
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('individuallyowned') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Individually-Owned Units
                        </a>
                    </div>
                </div>

                <!-- Operations Menu -->
                <div class="mb-1">
                    <button @click="menus.operations = !menus.operations"
                        class="w-full px-4 py-2.5 text-left rounded-lg flex items-center justify-between hover:bg-gray-50 transition-colors"
                        :class="menus.operations ? 'bg-gray-50' : ''">
                        <span class="font-medium text-gray-700">Operations</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            :class="menus.operations ? 'transform rotate-90' : ''"
                            class="w-5 h-5 transition-transform"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <div x-show="menus.operations" class="ml-4 space-y-1 mt-1">
                        <a href="{{ route('generalinfo') }}" 
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('generalinfo') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            General Info
                        </a>
                        {{-- <a href="{{ route('membership') }}" 
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('membership') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Membership
                        </a> --}}
                        <a href="{{ route('employment') }}" 
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('employment') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Employment
                        </a>
                        {{-- <a href="{{ route('units') }}"
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('units') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Units
                        </a> --}}
                        {{-- <a href="{{ route('cgs') }}" 
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('cgs') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            CGS
                        </a> --}}
                    </div>
                </div>

                <!-- Governance Menu -->
                <div class="mb-1">
                    <button @click="menus.governance = !menus.governance"
                        class="w-full px-4 py-2.5 text-left rounded-lg flex items-center justify-between hover:bg-gray-50 transition-colors"
                        :class="menus.governance ? 'bg-gray-50' : ''">
                        <span class="font-medium text-gray-700">Governance</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            :class="menus.governance ? 'transform rotate-90' : ''"
                            class="w-5 h-5 transition-transform"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <div x-show="menus.governance" class="ml-4 space-y-1 mt-1">
                        <a href="{{ route('officerslist') }}" 
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('officers') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Officers & BOD
                        </a>
                    </div>
                </div>

                <!-- Financial Menu -->
                <div class="mb-1">
                    <button @click="menus.financial = !menus.financial"
                        class="w-full px-4 py-2.5 text-left rounded-lg flex items-center justify-between hover:bg-gray-50 transition-colors"
                        :class="menus.financial ? 'bg-gray-50' : ''">
                        <span class="font-medium text-gray-700">Financial</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            :class="menus.financial ? 'transform rotate-90' : ''"
                            class="w-5 h-5 transition-transform"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <div x-show="menus.financial" class="ml-4 space-y-1 mt-1">
                        {{-- <a href="#" 
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('finances') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Finances
                        </a> --}}
                        <a href="{{ route('grants') }}" 
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('grants') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Grants & Donations
                        </a>
                        <a href="{{ route('loans') }}" 
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('loans') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Loans
                        </a>
                        <a href="{{ route('businesses') }}" 
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('businesses') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Businesses
                        </a>
                    </div>
                </div>

                <!-- Development Menu -->
                <div class="mb-1">
                    <button @click="menus.development = !menus.development"
                        class="w-full px-4 py-2.5 text-left rounded-lg flex items-center justify-between hover:bg-gray-50 transition-colors"
                        :class="menus.development ? 'bg-gray-50' : ''">
                        <span class="font-medium text-gray-700">Development</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            :class="menus.development ? 'transform rotate-90' : ''"
                            class="w-5 h-5 transition-transform"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                    <div x-show="menus.development" class="ml-4 space-y-1 mt-1">
                        <a href="{{ route('trainings') }}"
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('trainings') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Trainings & Seminars
                        </a>
                        {{-- <a href="{{ route('scholarships') }}"
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('scholarships') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Scholarships
                        </a> --}}
                        {{-- <a href="{{ route('cetos') }}"
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('cetos') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            CETOS
                        </a> --}}
                        <a href="{{ route('awards') }}" 
                           class="block px-4 py-2 text-sm rounded-lg transition-colors {{ request()->routeIs('awards') ? 'bg-blue-50 text-blue-600 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            Awards
                        </a>
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>