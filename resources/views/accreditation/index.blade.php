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
                <li>For Existing Cooperative: Bank Certificate of Deposit representing the paid-up capital of the cooperative based on the type of unit or latest Audited Financial Statements</li>
            </ul>
        </div>
   
        <!-- Steps Section -->
        <div class="mt-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Steps</h3>
            <ol class="list-decimal pl-5 text-gray-600 space-y-2">
                <li>Ready all required documents.
                    <ul class="list-disc pl-5 mt-1">
                        <li>Request Letter Signed by the TC Chairperson</li>
                        <li>req 2</li>
                        <li>req 3</li>
                    </ul>
                </li>
                <li>Click next and fill out the form.</li>
                <li>Upload the documents.</li>
                <li>Double-check all information.</li>
                <li>Submit, and you'll be given a reference number.</li>
                <li>Wait for an update through your email and the website TCOPS.</li>
            </ol>
        </div>

        <div class="mt-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-2">Reminder</h3>
            Your information saved in this website will be used for validation and processing of Accreditation. <br>
            Please be sure that all information are updated and correct, if not you can edit your information first through this <a href="#" class="text-blue-800">link</a>.
        </div>
    
        <!-- Footer Buttons -->
        <div class="mt-10 flex justify-between ">
            <a class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none">
                Previous
            </a>
            <a href="/accreditation/form1" class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 focus:outline-none">
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
                <button id="cancelButton" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none">
                    No
                </button>
                <a href="{{ url('/dash') }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none">
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