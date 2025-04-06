<x-accredit-steps>
    <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-white">

        <!-- Requirements Section -->
        <div>
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Requirements</h3>
            <ul class="list-disc pl-5 text-gray-600 space-y-2">
                <li>Photocopy of Certificate of Registration issued by the Cooperative Development Authority (CDA)</li>
                <li>At least 15 units of OR/CR together with the copy of Decision/Order of CPC</li>
                <li>
                    For Newly Registered Transport Cooperative:
                    <ul class="list-disc pl-5 mt-1">
                        <li>PUJs and Multicabs: <span class="font-medium">P300,000.00</span></li>
                        <li>Airconditioned Vans, Taxis: <span class="font-medium">P750,000.00</span></li>
                        <li>PUBs and Mini-Bus: <span class="font-medium">P1 Million</span></li>
                        <li>Trucks for Hire (2 units): <span class="font-medium">P200,000.00</span></li>
                        <li>Tricycles: <span class="font-medium">P15,000.00</span></li>
                    </ul>
                </li>
                <li>For Existing Cooperative: Bank Certificate of Deposit representing the paid-up capital of the
                    cooperative based on the type of unit or latest Audited Financial Statements</li>
            </ul>
        </div>

        <!-- Steps Section -->
        <div class="mt-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Steps</h3>
            <ol class="list-decimal pl-5 text-gray-600 space-y-2">
                <li>
                    Prepare all required documents:
                    <ul class="list-disc pl-5 mt-1">
                        <li>Request Letter signed by the TC Chairperson</li>
                        <li>Photocopy of the Certificate of Registration issued by the Cooperative Development Authority
                            (CDA)</li>
                        <li>At least 15 units of OR/CR, along with the copy of the Decision/Order of the CPC</li>
                        <li>Bank Certificate of Deposit representing the paid-up capital of the cooperative</li>
                        <li><span class="text-green-700">Note:</span> Please compile all documents into one PDF file</li>
                    </ul>
                </li>

                <li>Click "Next" and complete the form.</li>
                <li>Click "Next" again to upload the documents. The file format must be PDF, and the size should not
                    exceed 10MB.</li>
                <li>Click "Next" and double-check all information.</li>
                <li>Submit the form. You will be able to download the reference number.</li>
                <li>An email containing the details and further instructions will also be sent to your email address: {{ Auth::user()->email }}.</li>
            </ol>
        </div>

        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-md mb-4 mt-10">
            <div class="flex">
                <svg class="w-6 h-6 text-yellow-500 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13 16h-1v-4h-1m1-4h.01M12 18a9 9 0 110-18 9 9 0 010 18z" />
                </svg>
                <div>
                    <p class="font-semibold">Reminder</p>
                    <p class="text-sm mt-1">
                        The information you saved on this website will be used solely for processing this application.
                        Please ensure all details are accurate and updated.
                    </p>
                </div>
            </div>
        </div>


        <!-- Footer Buttons -->
        <div class="mt-10 flex justify-between ">
            <a href="{{ route('dashboard') }}"
                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none">
                Previous
            </a>
            <a href="/accreditation/form1"
                class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 focus:outline-none">
                Next
            </a>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 items-center justify-center hidden z-50">
        <div class="bg-white rounded-lg p-6 w-80 shadow-lg">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Confirmation</h3>
            <p class="text-gray-600 mb-5">Are you sure you want to go back?</p>
            <div class="flex justify-end space-x-3">
                <button id="cancelButton"
                    class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none">
                    No
                </button>
                <a href="{{ url('/dash') }}"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
                    Yes
                </a>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const backButton = document.getElementById('backButton');
            const confirmModal = document.getElementById('confirmModal');
            const cancelButton = document.getElementById('cancelButton');

            backButton.addEventListener('click', function() {
                confirmModal.classList.remove('hidden');
            });

            cancelButton.addEventListener('click', function() {
                confirmModal.classList.add('hidden');
            });

            // Close modal when clicking outside
            window.addEventListener('click', function(event) {
                if (event.target === confirmModal) {
                    confirmModal.classList.add('hidden');
                }
            });
        });
    </script>
</x-accredit-steps>
