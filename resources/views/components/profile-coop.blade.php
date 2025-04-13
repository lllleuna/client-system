<!-- Profile Dropdown -->
<div class="relative" x-data="{ profileOpen: false }">
    <button @click="profileOpen = !profileOpen" class="focus:outline-none">
        <img src="{{ $user->profile_picture ? asset('shared/uploads/' . $user->profile_picture) : asset('images/default.png') }}"
            class="h-12 w-12 rounded-full transition-transform duration-300 hover:scale-105" alt="Cooperative Logo">
    </button>
    <!-- Profile Dropdown Menu -->
    <div x-show="profileOpen" @click.away="profileOpen = false"
        class="absolute right-0 mt-2 w-56 bg-white rounded-lg shadow-lg z-50"
        x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        <div class="p-2">
            <div class="px-4 py-2 text-sm text-gray-700 border-b border-gray-200">
                <p class="font-semibold">My Account</p>
            </div>

            <a href="{{ route('profilesetting') }}"
                class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                Profile & Account Settings
            </a>

            <form method="POST" action="/logout" class="block">
                @csrf
                <button type="submit"
                    class="flex w-full items-center px-4 py-2 text-sm text-red-600 hover:bg-gray-100 rounded-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>
