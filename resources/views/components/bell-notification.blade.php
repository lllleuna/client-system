{{-- Notification Dropdown --}}
<div class="relative" x-data="{ open: false }">
    {{-- Bell Icon Button --}}
    <button @click="open = !open" class="relative p-2 rounded-full hover:bg-gray-100 transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600" viewBox="0 0 24 24" fill="currentColor">
            <path d="M12 2C10.343 2 9 3.343 9 5V6C6.243 6 4 8.243 4 11V16L2 18V19H22V18L20 16V11C20 8.243 17.757 6 15 6V5C15 3.343 13.657 2 12 2ZM6 11C6 9.346 7.346 8 9 8H15C16.654 8 18 9.346 18 11V16H6V11ZM10 21C10 22.104 10.896 23 12 23C13.104 23 14 22.104 14 21H10Z"/>
        </svg>
        
        {{-- Notification Badge - Backend will replace '3' with actual count --}}
        <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-500 rounded-full">
            3
        </span>
    </button>

    {{-- Dropdown Panel --}}
    <div x-show="open" 
         @click.away="open = false"
         class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-200 z-50">
        
        {{-- Header --}}
        <div class="flex items-center justify-between px-4 py-2 border-b border-gray-200">
            <h3 class="text-lg font-semibold text-gray-700">Notifications</h3>
            <button @click="open = false" class="text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        {{-- Notifications List - Backend will loop through actual notifications --}}
        <div class="max-h-96 overflow-y-auto">
            {{-- Success Notification Example --}}
            <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition-colors">
                <div class="flex items-start space-x-3">
                    <div class="p-2 rounded-full text-green-600 bg-green-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Document "Annual Report.pdf" successfully uploaded</p>
                        <p class="text-xs text-gray-500 mt-1">2 minutes ago</p>
                    </div>
                </div>
            </div>

            {{-- Warning Notification Example --}}
            <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition-colors">
                <div class="flex items-start space-x-3">
                    <div class="p-2 rounded-full text-yellow-600 bg-yellow-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Please complete your profile information</p>
                        <p class="text-xs text-gray-500 mt-1">1 hour ago</p>
                    </div>
                </div>
            </div>

            {{-- Info Notification Example --}}
            <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition-colors">
                <div class="flex items-start space-x-3">
                    <div class="p-2 rounded-full text-blue-600 bg-blue-50">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-800">Your document has been reviewed by the admin</p>
                        <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Footer --}}
        <div class="px-4 py-2 border-t border-gray-200">
            <a href="#" class="text-sm text-blue-600 hover:text-blue-800 font-medium">
                View all notifications
            </a>
        </div>
    </div>
</div>