{{-- page-switcher.blade.php --}}

<div class="fixed bottom-4 right-4 z-50">
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-1.5 flex items-center">
        @php
            $currentUrl = request()->url();
            $isAdmin = str_contains($currentUrl, 'otcmis.ddns.net');
            $isPublic = str_contains($currentUrl, 'clientport.ddns.net');
            
            $adminUrl = "https://otcmis.ddns.net/";
            $publicUrl = "https://clientport.ddns.net/";
            
            // Keep the path when switching
            $currentPath = parse_url($currentUrl, PHP_URL_PATH) ?? '';
            $adminUrl .= ltrim($currentPath, '/');
            $publicUrl .= ltrim($currentPath, '/');
        @endphp
        
        <div class="relative rounded-full flex p-1 bg-gray-100 dark:bg-gray-700">
            <a href="{{ $adminUrl }}" 
               class="relative rounded-full px-4 py-1.5 transition-all duration-300 ease-in-out flex items-center space-x-1 {{ $isAdmin ? 'bg-blue-900 text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:text-indigo-700 dark:hover:text-indigo-400' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <span class="font-medium text-sm">Internal</span>
            </a>
            
            <a href="{{ $publicUrl }}" 
               class="relative rounded-full px-4 py-1.5 transition-all duration-300 ease-in-out flex items-center space-x-1 {{ $isPublic ? 'bg-blue-900 text-white shadow-md' : 'text-gray-700 dark:text-gray-300 hover:text-indigo-700 dark:hover:text-indigo-400' }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                </svg>
                <span class="font-medium text-sm">Public</span>
            </a>
        </div>
    </div>
</div>