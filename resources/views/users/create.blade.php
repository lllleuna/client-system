<form action="/users/create" method="POST" id="create_form">
    @csrf
    
    <x-form-title>Create Account</x-form-title>

    <x-form-label class="text-blue-900">Business Information</x-form-label>
    <x-form-input name="accreditation_no" id="accreditation_no" placeholder="Accreditation No." :value="old('accreditation_no')"/>
    <x-form-error name="accreditation_no" bag="signup"/>

    <x-form-input name="tc_name" id="tc_name" placeholder="Transport Cooperative Name" :value="old('tc_name')" required/>
    <x-form-error name="tc_name" bag="signup"/>

    {{-- Chairperson's Name --}}
    <x-form-label class="text-blue-900">Chairperson's Personal Information</x-form-label>
    <div class="flex">
        <x-form-input name="chair_fname" id="chair_fname" placeholder="First name" :value="old('chair_fname')" />
        <x-form-input name="chair_mname" id="chair_mname" placeholder="Middle Name" :value="old('chair_mname')" />
    </div>
    <div class="flex">
        <x-form-error name="chair_fname" bag="signup"/>
        <x-form-error name="chair_mname" bag="signup"/>
    </div>

    <div class="flex">
        <x-form-input name="chair_lname" id="chair_lname" placeholder="Last name" :value="old('chair_lname')" required/>
        <x-form-input name="chair_suffix" id="chair_suffix" placeholder="Suffix" :value="old('chair_suffix')" />
    </div>
    <div class="flex">
        <x-form-error name="chair_lname" bag="signup"/>
        <x-form-error name="chair_suffix" bag="signup"/>
    </div>

    <x-form-input name="contact_no" id="contact_no" placeholder="Contact No." :value="old('contact_no')" required/>
    <x-form-error name="contact_no" bag="signup"/>

    <x-form-label class="text-blue-900">Account Information</x-form-label>
    <x-form-input name="email" id="email" placeholder="Business Official Email" :value="old('email')" required/>
    <x-form-error name="email" bag="signup"/>

    <x-form-input name="password" id="password" type="password" placeholder="Password" required/>
    <x-form-error name="password" bag="signup"/>

    <x-form-input name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirm Password" required/>
    <x-form-error name="password_confirmation" bag="signup" />

    <div class="flex justify-between mt-2 mb-2">
        <div>
            <x-cancel-button onclick="closeModal('modalCreate'), resetForm('create_form')"> Discard </x-cancel-button>
        </div>
        <div>
            <x-form-submit-button> Create </x-form-submit-button>
        </div>
    </div>

</form>

{{-- 
    <div class="flex">
        <x-form-select name="island-groups" id="island-groups" required>
            <option class="hidden" value="" disabled selected>Select Area</option>
        </x-form-select>
    
        <x-form-select name="regions" id="regions" disabled required>
            <option class="hidden" value="" disabled selected>Select Region</option>
        </x-form-select>
    
        <x-form-select name="provinces" id="provinces" disabled>
            <option class="hidden" value="" disabled selected>Select Province</option>
        </x-form-select>
    </div>
    <div class="flex">
        <x-form-error name="island-groups" />
        <x-form-error name="regions" />
        <x-form-error name="provinces" />
    </div>


    <div class="flex">
        <x-form-select name="cities-municipalities" id="cities-municipalities" disabled required>
            <option class="hidden" value="" disabled selected>Select City/Municipality</option>
        </x-form-select>
    
        <x-form-select name="barangays" id="barangays" disabled required>
            <option class="hidden" value="" disabled selected>Select Barangay</option>
        </x-form-select>
    </div>
    <div class="flex">
        <x-form-error name="cities-municipalities" />
        <x-form-error name="barangays" />
    </div>

    <x-form-input name="address" id="address" placeholder="Lot No. / Block / Street" :value="old('address')" required/>
    <x-form-error name="address" /> 
--}}
