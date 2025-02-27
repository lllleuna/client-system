@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <form action="/users/create" method="POST" id="create_form">
        @csrf
        
        <x-form-title>Account Creation</x-form-title>
    
        <x-form-label>Business Information</x-form-label>
        <x-form-input name="cda_reg_no" id="cda_reg_no" placeholder="CDA Registration No. (T-XXXXXXXX)" :value="old('cda_reg_no')" pattern="^T-\d{8}$" title="Format: T-XXXXXXXX (e.g., T-12345678)" required />
        <x-form-error name="cda_reg_no" bag="signup"/>
    
        <x-form-input name="tc_name" id="tc_name" placeholder="Transport Cooperative Name" :value="old('tc_name')" required/>
        <x-form-error name="tc_name" bag="signup"/>
    
        {{-- Chairperson's Name --}}
        <x-form-label>Cooperative Chairperson's Information</x-form-label>
        <div class="flex">
            <x-form-input name="chair_fname" id="chair_fname" placeholder="First name" :value="old('chair_fname')" />
            <x-form-input name="chair_mname" id="chair_mname" placeholder="Middle Name (optional)" :value="old('chair_mname')" />
        </div>
        <div class="flex">
            <x-form-error name="chair_fname" bag="signup"/>
            <x-form-error name="chair_mname" bag="signup"/>
        </div>
    
        <div class="flex">
            <x-form-input name="chair_lname" id="chair_lname" placeholder="Last name" :value="old('chair_lname')" required/>
            <x-form-input name="chair_suffix" id="chair_suffix" placeholder="Suffix (optional)" :value="old('chair_suffix')" />
        </div>
        <div class="flex">
            <x-form-error name="chair_lname" bag="signup"/>
            <x-form-error name="chair_suffix" bag="signup"/>
        </div>
    
        <x-form-input name="contact_no" id="contact_no" placeholder="Contact No. (e.g., 09123456789)" :value="old('contact_no')" pattern="^0\d{10}$" title="Format: 11 digits starting with 0 (e.g., 09123456789)" required />
        <x-form-error name="contact_no" bag="signup"/>

        <div class="flex">
            <x-form-select id="id_type" name="id_type" onchange="setIdInputMask()" :value="old('id_type')" required>
                <option value="" disabled selected>Select Type</option>
                <option value="passport">Philippine Passport</option>
                <option value="sss">SSS Card</option>
                <option value="gsis">GSIS Card</option>
                <option value="umid">UMID Card</option>
                <option value="driver_license">Driver's License</option>
                <option value="prc">PRC ID</option>
            </x-form-select>
            
            <x-form-input type="text" id="id_number" name="id_number" placeholder="Valid ID No." :value="old('id_number')" required/>
        </div>
        
    
        <x-form-label>Account Information</x-form-label>
        <x-form-input name="email" id="email" placeholder="Business Official Email" :value="old('email')" required/>
        <x-form-error name="email" bag="signup"/>
    
        <x-form-input name="password" id="password" type="password" placeholder="Password" required/>
        <x-form-error name="password" bag="signup"/>
    
        <x-form-input name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirm Password" required/>
        <x-form-error name="password_confirmation" bag="signup" />
    
        <div class="mt-10 flex justify-end p-4">
            <div>
                <button type="submit" id="submitBtn" 
                    class="bg-gray-400 text-gray-700 px-8 py-2 rounded-lg focus:outline-none cursor-not-allowed"
                    disabled>
                    Create Account
                </button>
            </div>
        </div>
        
        
    
    </form>


    <script>
        function setIdInputMask() {
            const idType = document.getElementById('id_type').value;
            const idNumberInput = document.getElementById('id_number');
        
            // Clear previous input mask or validation
            idNumberInput.value = '';
            idNumberInput.removeAttribute('pattern');
            idNumberInput.removeAttribute('title');
        
            switch(idType) {
                case 'passport':
                    idNumberInput.setAttribute('pattern', '[A-Z][0-9]{B}');
                    idNumberInput.setAttribute('title', 'Format: A1234567');
                    break;
                case 'sss':
                    idNumberInput.setAttribute('pattern', '[0-9]{2}-[0-9]{7}-[0-9]');
                    idNumberInput.setAttribute('title', 'Format: 12-3456789-0');
                    break;
                case 'gsis':
                    idNumberInput.setAttribute('pattern', '[0-9]{9}');
                    idNumberInput.setAttribute('title', 'Format: 9 digits (e.g., 123456789)');
                    break;
                case 'umid':
                    idNumberInput.setAttribute('pattern', '[0-9]{12}');
                    idNumberInput.setAttribute('title', 'Format: 12 digits (e.g., 123456789012)');
                    break;
                case 'driver_license':
                    idNumberInput.setAttribute('pattern', '[A-Z]{2}-[0-9]{7}|[N0-9]{9}');
                    idNumberInput.setAttribute('title', 'Format: AB-1234567 (New) or N12345678 (Old)');
                    break;
                case 'prc':
                    idNumberInput.setAttribute('pattern', '[0-9]{7}');
                    idNumberInput.setAttribute('title', 'Format: 7 digits (e.g., 1234567)');
                    break;
                default:
                    break;
            }
        }
        
        document.addEventListener("DOMContentLoaded", function () {
            checkFormValidity(); // Ensure the button is styled correctly initially
        });

        function checkFormValidity() {
            const form = document.getElementById("create_form");
            const submitButton = document.getElementById("submitBtn");

            const requiredFields = form.querySelectorAll("[required]");
            let allFilled = true;

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    allFilled = false;
                }
            });

            if (allFilled) {
                submitButton.disabled = false;
                submitButton.classList.remove("bg-gray-400", "cursor-not-allowed", "text-gray-700");
                submitButton.classList.add("bg-blue-800", "text-gray-200", "hover:bg-blue-900");
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove("bg-blue-800", "text-gray-200", "hover:bg-blue-900");
                submitButton.classList.add("bg-gray-400", "cursor-not-allowed", "text-gray-700");
            }
        }

        // Attach event listeners to all required fields
        document.querySelectorAll("#create_form [required]").forEach(field => {
            field.addEventListener("input", checkFormValidity);
            field.addEventListener("change", checkFormValidity);
        });
        </script>
    
@endsection