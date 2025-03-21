{{-- TO BE FILLED OUT AFTER THE FORM1
FOR FILE UPLOADS --}}
<x-accredit-steps>
    <form action="{{ route('processForm2') }}" method="POST" enctype="multipart/form-data" class="max-w-2xl mx-auto py-8">
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
                            class="w-full max-w-md h-auto object-contain rounded-lg cursor-pointer"
                            onclick="openModal(this)">
                    </div>
                </div>
            </div>
        </div>

        <!-- Image Modal -->
        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 flex justify-center items-center hidden">
            <div class="relative">
                <img id="modalImage" src="" class="max-w-full max-h-screen rounded-lg shadow-lg">
                <button type="button" class="absolute top-2 right-2 text-white text-3xl font-bold" onclick="closeModal()">&times;</button>
            </div>
        </div>


            <!-- File Upload Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Upload Your Requirements</h2>
                <div class="space-y-4">
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                        <input type="file" id="file_upload" name="file_upload" class="hidden" accept="image/*">
                        <label for="file_upload" id="upload_label" class="cursor-pointer">
                            <div class="space-y-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" 
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                          d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                                </svg>
                                <div class="text-gray-600">Click to upload your file</div>
                                <div class="text-sm text-gray-500">Images up to 10MB</div>
                            </div>
                        </label>
                        <!-- Image Preview -->
                        <div id="file_preview" class="mt-4 hidden">
                            <img id="preview_image" class="mx-auto rounded-lg shadow-md max-h-48" alt="Preview">
                            <p id="file_name" class="mt-2 text-gray-700"></p>
                            <button type="button" id="change_file" class="mt-2 px-2 py-1 bg-blue-500 text-white rounded-lg">Change File</button>
                        </div>
                    </div>
                    <x-form-error name="file_upload" class="text-sm text-red-600" />
                </div>
            </div>

            <!-- Comments Section -->
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Additional Comments</h2>
                <div class="space-y-2">
                    <label for="message" class="text-sm text-gray-600">
                        Please indicate any comments or clarifications regarding your application. Max: 300 Characters
                    </label>
                    <textarea id="message" name="message" rows="4"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            maxlength="300" oninput="updateCharCount()"
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
                    <p>The Center for Admission and Scholarship of the University of Makati (UMak) recognizes and protects your rights as data subject by applying appropriate security measures in compliance with existing laws on data privacy, records management and cyber security.</p>
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
                <div class="flex items-start space-x-3 mt-2">
                    <input type="checkbox" id="oath" name="oath" 
                        class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                    <label for="oath" class="text-sm text-gray-600">
                        I hereby certify that all information I have provided prior to and during this application, as recorded on this website, is true, correct, and updated to the best of my knowledge.
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
                <a href="/accreditation/form1" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none">
                    Previous
                </a>

                <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 focus:outline-none">Next</button>
            </div>

        </div>

    </form>
</x-accredit-steps>
<!-- JavaScript -->
<script>
    function openModal(img) {
        document.getElementById('modalImage').src = img.src;
        document.getElementById('imageModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('imageModal').classList.add('hidden');
    }
</script>