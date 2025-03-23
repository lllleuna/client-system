<x-accredit-steps>
    <div class="my-10 mx-auto w-full sm:w-2/3 md:w-4/5 lg:w-2/3 flex flex-col rounded-xl shadow-lg bg-white overflow-hidden">
        <!-- Header Section -->
        <div class="bg-blue-900 text-white p-6 text-center">
            <h2 class="text-2xl font-bold">Application Confirmation</h2>
            <p class="text-blue-100 mt-1">Please review your information carefully before submitting</p>
        </div>
        
        <!-- Content Section -->
        <div class="p-6 md:p-8">
            <!-- Information Cards -->
            <div class="space-y-6">
                <!-- Cooperative Information -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-5">
                    <h3 class="text-lg font-semibold text-blue-900 mb-4 pb-2 border-b border-gray-200">Cooperative Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Transportation Cooperative Name</p>
                            <p class="font-medium text-gray-800">{{ session('form_data.tc_name', 'N/A') }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">CDA Registration No</p>
                            <p class="font-medium text-gray-800">{{ $formData['cda_reg_no'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">CDA Registration Date</p>
                            <p class="font-medium text-gray-800">{{ $formData['cda_reg_date'] }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Address Information -->
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-5">
                    <h3 class="text-lg font-semibold text-blue-900 mb-4 pb-2 border-b border-gray-200">Address Information</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4">
                        <div>
                            <p class="text-sm text-gray-500">Street Address</p>
                            <p class="font-medium text-gray-800">{{ $formData['address'] }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Barangay</p>
                            <p class="font-medium text-gray-800">{{ $barangayName }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">City/Municipality</p>
                            <p class="font-medium text-gray-800">{{ $cityName }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Province</p>
                            <p class="font-medium text-gray-800">{{ $provinceName }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Area</p>
                            <p class="font-medium text-gray-800">{{ $formData['area'] }}</p>
                        </div>
                    </div>
                </div>
                
                <!-- Document Uploads -->
                @if(isset($formData['file_upload']))
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-5">
                    <h3 class="text-lg font-semibold text-blue-900 mb-4 pb-2 border-b border-gray-200">Attached Documents</h3>
                    <div class="bg-blue-50 p-4 rounded-lg flex items-center">
                        <div class="bg-blue-100 rounded-full p-2 mr-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Signed Letter Request</p>
                            <a href="{{ Storage::url($formData['file_upload']) }}" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center" target="_blank">
                                View Document
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Important Notice Section -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-yellow-800">Important Notice</h3>
                            <div class="mt-1 text-sm text-yellow-700">
                                <p>By submitting this application, you confirm that all information provided is accurate and complete. False information may result in the rejection of your application.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Footer/Actions Section -->
        <div class="bg-gray-50 p-6 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
            <a href="/accreditation/form2" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17l-5-5m0 0l5-5m-5 5h12" />
                </svg>
                Edit Information
            </a>
            <form action="{{ route('submitForm') }}" method="POST" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-900 hover:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Confirm & Submit
                    <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 -mr-1 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</x-accredit-steps>