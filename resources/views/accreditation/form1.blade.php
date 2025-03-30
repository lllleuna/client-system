{{-- TEXT INPUTS, SELECT, BASIC INFO OF TC --}}

<x-accredit-steps>
    <div class="my-6 mx-auto w-full sm:w-1/2 flex flex-col items-center p-5 rounded-lg shadow-md bg-white">
        <form action="{{ route('processForm1') }}" method="POST" id="form" name="form" class="w-full">
            @csrf

            <input type="text" name="application_type" class="hidden" value="accreditation" />

            <!-- Transport Cooperative Name -->
            <x-form-label for="tc_name">Transport Cooperative Name</x-form-label>
            <x-form-input name="tc_name" id="tc_name" type="text"
                value="{{ old('tc_name', $formData['tc_name'] ?? Auth::user()->tc_name) }}" required />
            <x-form-error name="tc_name" />

            <!-- CDA Registration Details -->
            <div class="flex w-full space-x-2">
                <div class="w-1/2">
                    <x-form-label for="cda_reg_no">CDA Registration No.</x-form-label>
                    <x-form-input name="cda_reg_no" id="cda_reg_no" type="text"
                        value="{{ old('tc_name', $formData['cda_reg_no'] ?? Auth::user()->cda_reg_no) }}" required />
                    <x-form-error name="cda_reg_no" />
                </div>
                <div class="w-1/2">
                    <x-form-label for="cda_reg_date">CDA Registration Date</x-form-label>
                    <x-form-input name="cda_reg_date" id="cda_reg_date" type="date"
                    value="{{ old('cda_reg_date', $formData['cda_reg_date'] ?? $coopinfo->cda_registration_date) }}" required />
                    <x-form-error name="cda_reg_date" />
                </div>
            </div>

            <!-- Location Details from Github repo (API)-->
            <div class="flex w-full space-x-2">
                <div class="w-1/3">
                    <x-form-label for="region">Region</x-form-label>
                    <x-form-select name="region" id="regions" required>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="region" />
                </div>
                <div class="w-1/2">
                    <x-form-label for="city_municipality">City/Municipality</x-form-label>
                    <x-form-select name="city_municipality" id="cities-municipalities" disabled required>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="city_municipality" />
                </div>
                <div class="w-1/2">
                    <x-form-label for="barangay">Barangay</x-form-label>
                    <x-form-select name="barangay" id="barangays" disabled required>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="barangay" />
                </div>
            </div>


            <!-- Business Address -->
            <x-form-label for="address">Business Address</x-form-label>
            <x-form-input name="address" id="address" placeholder="Lot No. / Block / Street"
                value="{{ $formData['address'] ?? '' }}" required />
            <x-form-error name="address" />

            <div class="mt-10 flex justify-between ">
                <a href="/accreditation"
                    class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none">
                    Previous
                </a>
                <button type="submit"
                    class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 focus:outline-none">Next</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let dateInput = document.getElementById("cda_reg_date");
            let today = new Date().toISOString().split("T")[0];
            dateInput.setAttribute("max", today);
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Get form elements
            const form = document.getElementById('form');
            const tcNameInput = document.getElementById('tc_name');
            const cdaRegNoInput = document.getElementById('cda_reg_no');
            const submitButton = form.querySelector('button[type="submit"]');
            const requiredInputs = form.querySelectorAll('[required]');

            // Function to validate CDA Registration Number format (T-XXXXXXXX)
            function validateCdaRegNo(value) {
                const regex = /^T-\d{8}$/;
                return regex.test(value);
            }

            // Add input event listener for TC Name
            tcNameInput.addEventListener('input', function() {
                if (this.value && this.value !== this.defaultValue) {
                    // Create or update message element
                    let messageEl = this.parentNode.querySelector('.validation-message');
                    if (!messageEl) {
                        messageEl = document.createElement('p');
                        messageEl.className = 'validation-message text-amber-600 text-sm mt-1';
                        this.parentNode.insertBefore(messageEl, this.nextSibling);
                    }
                    messageEl.textContent =
                        "Please ensure the cooperative name is entered in proper format (e.g., ABC Transport Cooperative).";
                } else {
                    // Remove message if value is empty or unchanged
                    const messageEl = this.parentNode.querySelector('.validation-message');
                    if (messageEl) messageEl.remove();
                }
            });

            // Add input event listener for CDA Registration Number
            cdaRegNoInput.addEventListener('input', function() {
                // Create or update message element
                let messageEl = this.parentNode.querySelector('.validation-message');
                if (!messageEl) {
                    messageEl = document.createElement('p');
                    messageEl.className = 'validation-message text-sm mt-1';
                    this.parentNode.insertBefore(messageEl, this.nextSibling);
                }

                if (!validateCdaRegNo(this.value)) {
                    this.classList.add('border-red-500');
                    messageEl.className = 'validation-message text-red-500 text-sm mt-1';
                    messageEl.textContent =
                        "Please enter a valid CDA Registration Number in the format T-XXXXXXXX (e.g., T-12345678).";
                } else {
                    this.classList.remove('border-red-500');
                    messageEl.className = 'validation-message text-green-500 text-sm mt-1';
                    messageEl.textContent = "Valid CDA Registration Number format.";
                }
            });

            // Function to check if all required fields are filled
            function checkRequiredFields() {
                let allFilled = true;
                let cdaRegNoValid = true;

                requiredInputs.forEach(input => {
                    if (!input.value.trim()) {
                        allFilled = false;
                    }

                    // Check if CDA Reg No has correct format
                    if (input.id === 'cda_reg_no' && !validateCdaRegNo(input.value)) {
                        cdaRegNoValid = false;
                    }
                });

                // Enable/disable submit button based on validation
                submitButton.disabled = !(allFilled && cdaRegNoValid);
                submitButton.classList.toggle('opacity-50', !(allFilled && cdaRegNoValid));
                submitButton.classList.toggle('cursor-not-allowed', !(allFilled && cdaRegNoValid));
            }

            // Add form validation before submit
            form.addEventListener('submit', function(e) {
                if (!validateCdaRegNo(cdaRegNoInput.value)) {
                    e.preventDefault();
                    alert("Please correct the CDA Registration Number format (T-XXXXXXXX).");
                    cdaRegNoInput.focus();
                }
            });

            // Check fields on any input change
            requiredInputs.forEach(input => {
                input.addEventListener('input', checkRequiredFields);
            });

            // Initial check
            checkRequiredFields();

            // Date validation (already exists but included for completeness)
            let dateInput = document.getElementById("cda_reg_date");
            let today = new Date().toISOString().split("T")[0];
            dateInput.setAttribute("max", today);
        });
    </script>


    {{-- // script is in this directory 'accredit-steps' --}}
</x-accredit-steps>
