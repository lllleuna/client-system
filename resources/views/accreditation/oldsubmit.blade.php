<x-accredit-steps>
    <form action="/accreditation/create" method="POST" id="form" name="form" enctype="multipart/form-data" class="max-w-2xl mx-auto py-8">
        @csrf
        <!-- Tutorial Section -->
        <div class="space-y-6">
            <!-- Steps Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-2xl font-semibold text-gray-800 mb-6">Getting Started</h2>
                
                <div class="space-y-8">
                    <!-- Tutorial -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-medium text-gray-700">Sample of Compiled Requirements</h3>
                        <div class="flex justify-center bg-gray-50 rounded-lg p-4">
                            <img src="{{ asset('images/tutorials.png') }}" alt="Sample Requirements" 
                                 class="w-full max-w-md h-auto object-contain rounded-lg">
                        </div>
                    </div>
                </div>
            </div>

            <!-- File Upload Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Upload Your Compiled Requirements</h2>
                <div class="space-y-4">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <input type="file" id="file_upload" name="file_upload" 
                               class="hidden" accept="image/*" required>
                        <label for="file_upload" class="cursor-pointer">
                            <div class="space-y-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                                <div class="text-gray-600">Click to upload or drag and drop</div>
                                <div class="text-sm text-gray-500">PDF files up to 10MB</div>
                            </div>
                        </label>
                    </div>
                    <x-form-error name="file_upload" class="text-sm text-red-600" />
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Additional Comments</h2>
                <div class="space-y-2">
                    <label for="message" class="text-sm text-gray-600">
                        Please indicate any comments or clarifications regarding your application
                    </label>
                    <textarea id="message" name="message" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            placeholder="Your message here..."></textarea>
                </div>
            </div>

            <!-- Department Section -->
            <div class="bg-orange-50 rounded-xl shadow-sm p-6 border border-orange-100">
                <h2 class="text-xl font-semibold text-orange-800">OTC Operational Department</h2>
            </div>

            <!-- Disclaimer Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Data Privacy Notice</h2>
                <div class="prose prose-sm text-gray-600">
                    <p>The Center for Admission and Scholarship of the Office of Transportation Cooperative (OTC) recognizes and protects your rights as data subject by applying appropriate security measures in compliance with existing laws on data privacy, records management and cyber security.</p>
                </div>
            </div>

            <!-- Consent Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-start space-x-3">
                    <input type="checkbox" id="consent_checkbox" name="consent" 
                           class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="consent_checkbox" class="text-sm text-gray-600">
                        I am giving my consent for the Office of the Transportation Cooperatives to collect and process my data.
                    </label>
                </div>
            </div>

            <!-- Contact Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Contact Information</h2>
                <div class="space-y-3">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <a href="official@otc.gov.ph" class="text-blue-600 hover:text-blue-800">official@otc.gov.ph</a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-blue-600 hover:text-blue-800">https://www.facebook.com/DOTR.OTC</a>
                        </div>
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            <p class="text-blue-600 hover:text-blue-800">09989461736 / 09772111310</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-10 flex justify-between ">
                <a class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none">
                    Previous
                </a>
                <a href="/accreditation/create" class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 focus:outline-none">
             <!-- Submit Button -->
            <div class="flex justify-between">
                <a href="/accreditation/create" :active="request()->is('accreditation')" class="bg-white text-black px-4 py-2 rounded-lg border border-gray-400 hover:bg-gray-200 focus:outline-none shadow-md">                    Back
                </a>
                <x-form-submit-button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                    Submit Application
                </a>
            </div>

        </div>
       
    </form>

    <!-- Submission Confirmation Modal -->
    <div id="submitConfirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-80 shadow-lg">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Confirm Submission</h3>
            <p class="text-gray-600 mb-5">Are you sure you want to submit your application? Once submitted, you cannot make changes.</p>
            <div class="flex justify-end space-x-3">
                <button id="cancelSubmit" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none">
                    Cancel
                </button>
                <button id="confirmSubmit" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                    Confirm
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const submitButton = document.getElementById('submitButton');
            const submitConfirmModal = document.getElementById('submitConfirmModal');
            const cancelSubmit = document.getElementById('cancelSubmit');
            const confirmSubmit = document.getElementById('confirmSubmit');
            const form = document.getElementById('form');
    
            submitButton.addEventListener('click', function(e) {
                e.preventDefault();
                submitConfirmModal.classList.remove('hidden');
            });
    
            cancelSubmit.addEventListener('click', function() {
                submitConfirmModal.classList.add('hidden');
            });
    
            confirmSubmit.addEventListener('click', function() {
                form.submit();
            });
    
            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === submitConfirmModal) {
                    submitConfirmModal.classList.add('hidden');
                }
            });
        });
    </script>
</x-accredit-steps>