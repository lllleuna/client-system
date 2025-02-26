<x-accredit-steps>
    <div class="my-6 mx-auto w-full sm:w-1/2 flex flex-col items-center p-5 rounded-lg shadow-md bg-white">
        <form action="/accreditation/create" method="POST" id="form" name="form" class="w-full">
            @csrf

            <!-- Cooperative Type Selection -->
            <x-form-label for="cooperative_type">Cooperative Type</x-form-label>
            <x-form-select name="cooperative_type" id="cooperative_type" required>
                <option class="hidden" value="" disabled selected>Select Type</option>
                <option value="Franchise Cooperative">Franchise Cooperative</option>
                <option value="Non-Franchise Cooperative">Non-Franchise Cooperative</option>
            </x-form-select>
            <x-form-error name="cooperative_type" />

            <!-- Transport Cooperative Name -->
            <x-form-label for="tc_name">Transport Cooperative Name</x-form-label>
            <x-form-input name="tc_name" id="tc_name" type="text" :value="old('tc_name')" required />
            <x-form-error name="tc_name" />

            <!-- CDA Registration Details -->
            <div class="flex w-full space-x-2">
                <div class="w-1/2">
                    <x-form-label for="cda_reg_no">CDA Registration No.</x-form-label>
                    <x-form-input name="cda_reg_no" id="cda_reg_no" type="text" :value="old('cda_reg_no')" required />
                    <x-form-error name="cda_reg_no" />
                </div>
                <div class="w-1/2">
                    <x-form-label for="cda_reg_date">CDA Registration Date</x-form-label>
                    <x-form-input name="cda_reg_date" id="cda_reg_date" type="date" :value="old('cda_reg_date')" required />
                    <x-form-error name="cda_reg_date" />
                </div>
            </div>

            <!-- Location Details -->
            <div class="flex w-full space-x-2">
                <div class="w-1/3">
                    <x-form-label for="area">Area</x-form-label>
                    <x-form-select name="area" id="island-groups" required>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="area" />
                </div>
                <div class="w-1/3">
                    <x-form-label for="region">Region</x-form-label>
                    <x-form-select name="region" id="regions" disabled required>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="region" />
                </div>
                <div class="w-1/3">
                    <x-form-label for="province">Province</x-form-label>
                    <x-form-select name="province" id="provinces" disabled>
                        <option class="hidden" value="" disabled selected>Select</option>
                    </x-form-select>
                    <x-form-error name="province" />
                </div>
            </div>

            <div class="flex w-full space-x-2">
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
            <x-form-input name="address" id="address" placeholder="Lot No. / Block / Street" :value="old('address')" required />
            <x-form-error name="address" />

            <div class="mt-10 flex justify-between ">
                <a class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none">
                    Previous
                </a>
                <a href="#" class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 focus:outline-none">
                    Next
                </a>
            </div>
        </form>
    </div>
</x-accredit-steps>
