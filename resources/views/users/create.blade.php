@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12 px-4 sm:px-6 lg:px-8 relative">
        <!-- Background patterns -->
        <div class="absolute inset-0 z-0 overflow-hidden opacity-10">
            <div class="absolute -top-24 -left-24 w-96 h-96 rounded-full bg-blue-600"></div>
            <div class="absolute top-1/4 right-0 w-80 h-80 rounded-full bg-indigo-600"></div>
            <div class="absolute bottom-0 left-1/3 w-64 h-64 rounded-full bg-blue-400"></div>
        </div>
        
        <div class="max-w-4xl mx-auto relative z-10">
            <!-- Page heading -->
            <div class="text-center mb-10">
                <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl lg:text-5xl tracking-tight">
                    Transport Cooperative Registration
                </h1>
                <p class="mt-3 text-gray-600 max-w-2xl mx-auto">
                    Create your account to access cooperative management services
                </p>
            </div>
            
            <form action="/users/create" method="POST" id="create_form" class="bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-100">
                @csrf
                
                <div class="bg-gradient-to-r from-blue-800 to-indigo-700 px-6 py-4">
                    <x-form-title class="text-2xl font-bold text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Account Creation
                    </x-form-title>
                </div>
                
                <div class="p-6 space-y-8">
                    <!-- Business Information Section -->
                    <div class="space-y-4 bg-white rounded-lg p-5 shadow-sm border border-gray-100">
                        <x-form-label class="text-xl font-semibold text-gray-700 border-b border-gray-200 pb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                            </svg>
                            Business Information
                        </x-form-label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cda_reg_no" class="block text-sm font-medium text-gray-600 mb-1">CDA Registration No.</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">T-</span>
                                    </div>
                                    <x-form-input name="cda_reg_no" id="cda_reg_no" placeholder="T-XXXXXXXX" :value="old('cda_reg_no')" pattern="^T-\d{8}$" title="Format: T-XXXXXXXX (e.g., T-12345678)" class="pl-8 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required />
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Format: T-XXXXXXXX (e.g., T-12345678)</p>
                                <x-form-error name="cda_reg_no" bag="signup" class="text-red-500 text-xs mt-1"/>
                            </div>
                            
                            <div>
                                <label for="tc_name" class="block text-sm font-medium text-gray-600 mb-1">Transport Cooperative Name</label>
                                <x-form-input name="tc_name" id="tc_name" placeholder="Enter cooperative name" :value="old('tc_name')" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required/>
                                <x-form-error name="tc_name" bag="signup" class="text-red-500 text-xs mt-1"/>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chairperson's Information Section -->
                    <div class="space-y-4 bg-white rounded-lg p-5 shadow-sm border border-gray-100">
                        <x-form-label class="text-xl font-semibold text-gray-700 border-b border-gray-200 pb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            Cooperative Chairperson's Information
                        </x-form-label>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="chair_fname" class="block text-sm font-medium text-gray-600 mb-1">First Name</label>
                                <x-form-input name="chair_fname" id="chair_fname" placeholder="First name" :value="old('chair_fname')" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required />
                                <x-form-error name="chair_fname" bag="signup" class="text-red-500 text-xs mt-1"/>
                            </div>
                            
                            <div>
                                <label for="chair_mname" class="block text-sm font-medium text-gray-600 mb-1">Middle Name <span class="text-gray-400">(optional)</span></label>
                                <x-form-input name="chair_mname" id="chair_mname" placeholder="Middle name" :value="old('chair_mname')" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" />
                                <x-form-error name="chair_mname" bag="signup" class="text-red-500 text-xs mt-1"/>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="chair_lname" class="block text-sm font-medium text-gray-600 mb-1">Last Name</label>
                                <x-form-input name="chair_lname" id="chair_lname" placeholder="Last name" :value="old('chair_lname')" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required/>
                                <x-form-error name="chair_lname" bag="signup" class="text-red-500 text-xs mt-1"/>
                            </div>
                            
                            <div>
                                <label for="chair_suffix" class="block text-sm font-medium text-gray-600 mb-1">Suffix <span class="text-gray-400">(optional)</span></label>
                                <x-form-input name="chair_suffix" id="chair_suffix" placeholder="e.g., Jr., Sr., III" :value="old('chair_suffix')" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" />
                                <x-form-error name="chair_suffix" bag="signup" class="text-red-500 text-xs mt-1"/>
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="contact_no" class="block text-sm font-medium text-gray-600 mb-1">Contact Number</label>
                                <div class="relative" title="Format: 12 digits starting with 63 (e.g., 639123456789)">
                                    <x-form-input 
                                        name="contact_no" 
                                        id="contact_no" 
                                        placeholder="639123456789" 
                                        :value="old('contact_no')" 
                                        pattern="^63\d{10}$" 
                                        title="Format: 12 digits starting with 63 (e.g., 639123456789)" 
                                        class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" 
                                        required 
                                    />
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Format: 12 digits starting with 63 (e.g., 639123456789)</p>
                                <x-form-error name="contact_no" bag="signup" class="text-red-500 text-xs mt-1"/>
                            </div>
                        
                            <div>
                                <!-- Placeholder to maintain grid -->
                            </div>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="id_type" class="block text-sm font-medium text-gray-600 mb-1">ID Type</label>
                                <x-form-select id="id_type" name="id_type" onchange="setIdInputMask()" :value="old('id_type')" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required>
                                    <option value="" disabled selected>Select ID Type</option>
                                    <option value="passport">Philippine Passport</option>
                                    <option value="sss">SSS Card</option>
                                    <option value="gsis">GSIS Card</option>
                                    <option value="umid">UMID Card</option>
                                    <option value="driver_license">Driver's License</option>
                                    <option value="prc">PRC ID</option>
                                </x-form-select>
                            </div>
                            
                            <div>
                                <label for="id_number" class="block text-sm font-medium text-gray-600 mb-1">ID Number</label>
                                <x-form-input type="text" id="id_number" name="id_number" placeholder="Enter ID number" :value="old('id_number')" class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required/>
                                <p id="id_format_hint" class="text-xs text-gray-500 mt-1">Please select an ID type first</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Account Information Section -->
                    <div class="space-y-4 bg-white rounded-lg p-5 shadow-sm border border-gray-100">
                        <x-form-label class="text-xl font-semibold text-gray-700 border-b border-gray-200 pb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1 text-blue-600" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd" />
                            </svg>
                            Account Information
                        </x-form-label>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Business Official Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <x-form-input name="email" id="email" type="email" placeholder="name@company.com" :value="old('email')" class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required/>
                                </div>
                                <x-form-error name="email" bag="signup" class="text-red-500 text-xs mt-1"/>
                            </div>
                            
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <x-form-input name="password" id="password" type="password" placeholder="••••••••" class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required/>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Must be at least 8 characters</p>
                                <x-form-error name="password" bag="signup" class="text-red-500 text-xs mt-1"/>
                            </div>
                            
                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-600 mb-1">Confirm Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <x-form-input name="password_confirmation" id="password_confirmation" type="password" placeholder="••••••••" class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" required/>
                                </div>
                                <x-form-error name="password_confirmation" bag="signup" class="text-red-500 text-xs mt-1"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-between">
                            <div class="text-sm text-gray-600">
                                Already have an account? 
                                <a href="/" class="font-medium text-blue-600 hover:text-blue-500">
                                    Sign in
                                </a>
                            </div>
                            <button type="submit" id="submitBtn" 
                                class="bg-gray-400 text-gray-700 px-8 py-3 rounded-lg focus:outline-none cursor-not-allowed transition duration-300 ease-in-out"
                                disabled>
                                Create Account
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            
            <!-- Help text -->
            <div class="mt-6 text-center text-gray-500 text-sm">
                Need help? Contact support at <a href="mailto:official@otc.gov.ph" class="text-blue-600 hover:underline">official@otc.gov.ph</a>
            </div>
        </div>
    </div>

    <script>
        function setIdInputMask() {
            const idType = document.getElementById('id_type').value;
            const idNumberInput = document.getElementById('id_number');
            const formatHint = document.getElementById('id_format_hint');
        
            // Clear previous input mask or validation
            idNumberInput.value = '';
            idNumberInput.removeAttribute('pattern');
            idNumberInput.removeAttribute('title');
        
            switch(idType) {
                case 'passport':
                    idNumberInput.setAttribute('pattern', '[A-Z][0-9]{B}');
                    idNumberInput.setAttribute('title', 'Format: A1234567');
                    formatHint.textContent = 'Format: A1234567';
                    break;
                case 'sss':
                    idNumberInput.setAttribute('pattern', '[0-9]{2}-[0-9]{7}-[0-9]');
                    idNumberInput.setAttribute('title', 'Format: 12-3456789-0');
                    formatHint.textContent = 'Format: 12-3456789-0';
                    break;
                case 'gsis':
                    idNumberInput.setAttribute('pattern', '[0-9]{9}');
                    idNumberInput.setAttribute('title', 'Format: 9 digits (e.g., 123456789)');
                    formatHint.textContent = 'Format: 9 digits (e.g., 123456789)';
                    break;
                case 'umid':
                    idNumberInput.setAttribute('pattern', '[0-9]{12}');
                    idNumberInput.setAttribute('title', 'Format: 12 digits (e.g., 123456789012)');
                    formatHint.textContent = 'Format: 12 digits (e.g., 123456789012)';
                    break;
                case 'driver_license':
                    idNumberInput.setAttribute('pattern', '[A-Z]{2}-[0-9]{7}|[N0-9]{9}');
                    idNumberInput.setAttribute('title', 'Format: AB-1234567 (New) or N12345678 (Old)');
                    formatHint.textContent = 'Format: AB-1234567 (New) or N12345678 (Old)';
                    break;
                case 'prc':
                    idNumberInput.setAttribute('pattern', '[0-9]{7}');
                    idNumberInput.setAttribute('title', 'Format: 7 digits (e.g., 1234567)');
                    formatHint.textContent = 'Format: 7 digits (e.g., 1234567)';
                    break;
                default:
                    formatHint.textContent = 'Please select an ID type first';
                    break;
            }
            
            checkFormValidity();
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
                submitButton.classList.add("bg-gradient-to-r", "from-blue-600", "to-indigo-700", "text-white", "hover:from-blue-700", "hover:to-indigo-800", "shadow-lg", "hover:shadow-xl");
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove("bg-gradient-to-r", "from-blue-600", "to-indigo-700", "text-white", "hover:from-blue-700", "hover:to-indigo-800", "shadow-lg", "hover:shadow-xl");
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