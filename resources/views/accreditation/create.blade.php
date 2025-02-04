<x-accredit-steps>
    <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-white">
        
        <form action="/accreditation/create" method="POST" id="form" name="form">
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

        <div class="flex w-full space-x-2">
            <x-form-label class="w-1/2" for="cda_reg_no">CDA Registration No.</x-form-label>
            <x-form-label class="w-1/2" for="cda_reg_date">CDA Registration Date</x-form-label>
        </div>
        <div class="flex space-x-2">
            <x-form-input name="cda_reg_no" id="cda_reg_no" type="text" :value="old('cda_reg_no')" required/>
            <x-form-input name="cda_reg_date" id="cda_reg_date" type="date" :value="old('cda_reg_date')" required/>
        </div>
        <div class="flex w-full space-x-2">
            <x-form-error class="w-1/2" name="cda_reg_no" />
            <x-form-error class="w-1/2" name="cda_reg_date" />
        </div>

        <div class="flex w-full space-x-2">
            <x-form-label class="w-1/3" for="area">Area</x-form-label>
            <x-form-label class="w-1/3" for="region">Region</x-form-label>
            <x-form-label class="w-1/3" for="province">Province</x-form-label>
        </div>
        <div class="flex space-x-2">
            <x-form-select name="area" id="island-groups" required>
                <option class="hidden" value="" disabled selected>Select</option>
            </x-form-select>
            <x-form-select name="region" id="regions" disabled required>
                <option class="hidden" value="" disabled selected>Select</option>
            </x-form-select>
            <x-form-select name="province" id="provinces" disabled>
                <option class="hidden" value="" disabled selected>Select</option>
            </x-form-select>
        </div>
        <div class="flex space-x-2">
            <x-form-error class="w-1/3" name="area" />
            <x-form-error class="w-1/3" name="region" />
            <x-form-error class="w-1/3" name="province" />
        </div>

        <div class="flex w-full space-x-2">
            <x-form-label class="w-1/2" for="city_municipality">City/Municipality</x-form-label>
            <x-form-label class="w-1/2" for="barangay">Barangay</x-form-label>
        </div>
        <div class="flex space-x-2">
            <x-form-select name="city_municipality" id="cities-municipalities" disabled required>
                <option class="hidden" value="" disabled selected>Select</option>
            </x-form-select>
            <x-form-select name="barangay" id="barangays" disabled required>
                <option class="hidden" value="" disabled selected>Select</option>
            </x-form-select>
        </div>
        <div class="flex space-x-2">
            <x-form-error class="w-1/2" name="city_municipality" />
            <x-form-error class="w-1/2" name="barangay" />
        </div>
        
        <x-form-label for="address">Business Address</x-form-label>
        <x-form-input name="address" id="address" placeholder="Lot No. / Block / Street" :value="old('address')" required/>
        <x-form-error name="address" /> 

        <x-form-submit-button>Next</x-form-submit-button>
        </form>

    </div>
</x-accredit-steps>
