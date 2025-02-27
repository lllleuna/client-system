<x-accredit-steps>
    <div class="my-6 mx-auto w-full sm:w-1/2 flex flex-col items-center p-5 rounded-lg shadow-md bg-white">
        <form action="/accreditation/create" method="POST" id="form" name="form" class="w-full" novalidate>
            @csrf

            <!-- Cooperative Type Selection -->
            <x-form-label for="cooperative_type">Cooperative Type <span class="text-red-500">*</span></x-form-label>
            <x-form-select name="cooperative_type" id="cooperative_type" required>
                <option class="hidden" value="" disabled selected>Select Type</option>
                <option value="Franchise Cooperative">Franchise Cooperative</option>
                <option value="Non-Franchise Cooperative">Non-Franchise Cooperative</option>
            </x-form-select>
            <x-form-error name="cooperative_type" />

            <!-- Transport Cooperative Name -->
            <x-form-label for="tc_name">Transport Cooperative Name (Needs Database Validation) <span class="text-red-500">*</span></x-form-label>
            <x-form-input name="tc_name" id="tc_name" type="text" :value="old('tc_name')" required placeholder="Enter Cooperative Name" />
            <x-form-error name="tc_name" />

            <!-- CDA Registration Details -->
            <div class="flex w-full space-x-2">
                <div class="w-1/2">
                    <x-form-label for="cda_reg_no">CDA Registration No. (Needs Database Validation) <span class="text-red-500">*</span></x-form-label>
                    <x-form-input name="cda_reg_no" id="cda_reg_no" type="text" :value="old('cda_reg_no')" required placeholder="Enter Registration No." />
                    <x-form-error name="cda_reg_no" />
                </div>
                <div class="w-1/2">
                    <x-form-label for="cda_reg_date">CDA Registration Date <span class="text-red-500">*</span></x-form-label>
                    <x-form-input name="cda_reg_date" id="cda_reg_date" type="date" :value="old('cda_reg_date')" required />
                    <x-form-error name="cda_reg_date" />
                </div>
            </div>

            <!-- Location Details -->
            <div class="flex w-full space-x-2">
                <div class="w-1/3">
                    <x-form-label for="area">Area <span class="text-red-500">*</span></x-form-label>
                    <x-form-select name="area" id="island-groups" required>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="area" />
                </div>
                <div class="w-1/3">
                    <x-form-label for="region">Region <span class="text-red-500">*</span></x-form-label>
                    <x-form-select name="region" id="regions" disabled required>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="region" />
                </div>
                <div class="w-1/3">
                    <x-form-label for="province">Province <span class="text-red-500">*</span></x-form-label>
                    <x-form-select name="province" id="provinces" disabled required>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="province" />
                </div>
            </div>

            <div class="flex w-full space-x-2">
                <div class="w-1/2">
                    <x-form-label for="city_municipality">City/Municipality <span class="text-red-500">*</span></x-form-label>
                    <x-form-select name="city_municipality" id="cities-municipalities" disabled required>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="city_municipality" />
                </div>
                <div class="w-1/2">
                    <x-form-label for="barangay">Barangay <span class="text-red-500">*</span></x-form-label>
                    <x-form-select name="barangay" id="barangays" disabled required>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="barangay" />
                </div>
            </div>

            <!-- Business Address -->
            <x-form-label for="address">Business Address <span class="text-red-500">*</span></x-form-label>
            <x-form-input name="address" id="address" placeholder="Lot No. / Block / Street" :value="old('address')" required />
            <x-form-error name="address" />

            <!-- Submit Button -->
            <div class="flex justify-between w-full">
                <a href="/accreditation" :active="request()->is('accreditation')" class="bg-white text-black px-4 py-2 rounded-lg border border-gray-400 hover:bg-gray-200 focus:outline-none shadow-md">
                    Back
                </a>
                <x-form-submit-button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none">
                    Next
                </x-form-submit-button>
            </div>
        </form>
    </div>
</x-accredit-steps>

<!-- Improved Validation Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('form');
        const cdaRegDate = document.getElementById('cda_reg_date');
        const today = new Date().toISOString().split('T')[0];
        cdaRegDate.setAttribute('max', today); // Prevent future dates

        form.addEventListener('submit', function (event) {
            let isValid = true;
            const inputs = form.querySelectorAll('input, select');

            inputs.forEach(input => {
                const existingError = input.parentNode.querySelector('.text-red-500');

                if (!input.checkValidity()) {
                    isValid = false;
                    input.classList.add('border-red-500', 'bg-red-100');

                    if (!existingError) {
                        const errorMsg = document.createElement('p');
                        errorMsg.className = 'text-red-500 text-sm mt-1';
                        errorMsg.textContent = `${input.previousElementSibling?.textContent?.replace('*', '').trim()} is required.`;
                        input.parentNode.appendChild(errorMsg);
                    }
                } else {
                    input.classList.remove('border-red-500', 'bg-red-100');
                    if (existingError) existingError.remove();
                }
            });

            if (!isValid) {
                event.preventDefault();
            }
        });
    });
</script>
