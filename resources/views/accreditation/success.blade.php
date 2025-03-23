<x-accredit-steps>
    <div class="my-10 mx-auto w-full sm:w-2/3 md:w-1/2 lg:w-2/5 flex flex-col rounded-xl shadow-lg bg-white overflow-hidden">
        <!-- Success Icon and Header -->
        <div class="pt-10 pb-6 px-6 flex flex-col items-center">
            <div class="bg-green-100 rounded-full p-4 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h1 class="text-2xl md:text-3xl font-bold text-gray-800">Application Submitted!</h1>
            <p class="text-gray-500 mt-2 text-center">Your application has been successfully submitted and is now being processed.</p>
        </div>
        
        <!-- Reference Number Section -->
        <div class="bg-gray-50 py-8 px-6">
            <div class="bg-white rounded-lg border border-gray-200 p-6 shadow-sm">
                <p class="text-gray-600 text-center mb-2">Your Reference Number</p>
                <div class="flex justify-center">
                    <span class="text-green-700 text-2xl md:text-3xl font-bold tracking-wider px-4 py-2 bg-green-50 rounded-lg">
                        {{ request()->query('referenceNumber') }}
                    </span>
                </div>
                <p class="text-gray-500 text-sm text-center mt-4">Please save this number for tracking your application status</p>
            </div>
        </div>
        
        <!-- What's Next Section -->
        <div class="px-6 py-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-3">What's Next?</h2>
            <div class="space-y-3">
                <div class="flex items-start">
                    <div class="bg-blue-100 rounded-full p-1 mr-3 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600">Our team will review your application within 2-3 business days</p>
                </div>
                <div class="flex items-start">
                    <div class="bg-blue-100 rounded-full p-1 mr-3 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600">You'll receive email notifications about your application status</p>
                </div>
                <div class="flex items-start">
                    <div class="bg-blue-100 rounded-full p-1 mr-3 mt-0.5">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <p class="text-sm text-gray-600">You can track your application status from your dashboard</p>
                </div>
            </div>
        </div>
        
        <!-- Footer/Navigation Section -->
        <div class="bg-gray-50 p-6 flex justify-between items-center">
            <a href="#" onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                </svg>
                Print Receipt
            </a>
            <a href="/dash" class="inline-flex items-center px-4 py-2 rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                Go to Dashboard
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                </svg>
            </a>
        </div>
    </div>
</x-accredit-steps>