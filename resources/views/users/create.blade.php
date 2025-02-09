<form action="/users/create" method="POST" id="create_form" class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow-md">
    @csrf
    
    <div class="space-y-8">
        <!-- Form Header -->
        <div class="text-center">
            <x-form-title class="text-2xl font-bold text-gray-900">Create Your Account</x-form-title>
            <p class="mt-2 text-sm text-gray-600">Join our transportation cooperative network</p>
            <p class="mt-1 text-sm font-semibold text-red-600">All fields marked "(Required)" must be filled.</p>
        </div>

        <!-- Business Information Section -->
        <div class="space-y-4">
            <x-form-label class="text-lg font-semibold text-blue-900">Business Information</x-form-label>
            
            <!-- Accreditation Number Field -->
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <label for="accreditation_no" class="text-sm text-gray-700">Accreditation Number</label>
                    <span class="text-xs text-gray-500 italic">Optional - Can be provided after registration</span>
                </div>
                <x-form-input 
                    name="accreditation_no" 
                    id="accreditation_no" 
                    placeholder="Enter accreditation number if available" 
                    :value="old('accreditation_no')"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                />
                <x-form-error name="accreditation_no" />
            </div>

            <!-- Transport Cooperative Name -->
            <div class="space-y-2">
                <label for="tc_name" class="text-sm text-gray-700">Transport Cooperative Name (Required)</label>
                <x-form-input 
                    name="tc_name" 
                    id="tc_name" 
                    placeholder="Enter your cooperative name" 
                    :value="old('tc_name')" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                />
                <x-form-error name="tc_name" />
            </div>
        </div>

        <!-- Chairperson's Information Section -->
        <div class="space-y-4">
            <x-form-label class="text-lg font-semibold text-blue-900">Chairperson's Personal Information</x-form-label>
            
            <!-- Name Fields -->
            <div class="grid grid-cols-2 gap-4">
                <!-- First Name -->
                <div class="space-y-2">
                    <label for="chair_fname" class="text-sm text-gray-700">First Name (Required)</label>
                    <x-form-input 
                        name="chair_fname" 
                        id="chair_fname" 
                        placeholder="First name" 
                        :value="old('chair_fname')" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    />
                    <x-form-error name="chair_fname" />
                </div>

                <!-- Middle Name -->
                <div class="space-y-2">
                    <label for="chair_mname" class="text-sm text-gray-700">Middle Name (Enter 'NA' if none)</label>
                    <x-form-input 
                        name="chair_mname" 
                        id="chair_mname" 
                        placeholder="Middle name" 
                        :value="old('chair_mname')"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    />
                    <x-form-error name="chair_mname" />
                </div>
            </div>

            <!-- Last Name and Suffix -->
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="chair_lname" class="text-sm text-gray-700">Last Name (Required)</label>
                    <x-form-input 
                        name="chair_lname" 
                        id="chair_lname" 
                        placeholder="Last name" 
                        :value="old('chair_lname')" 
                        required
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    />
                    <x-form-error name="chair_lname" />
                </div>
                
                <div class="space-y-2">
                    <label for="chair_suffix" class="text-sm text-gray-700">Suffix (Enter 'NA' if none)</label>
                    <x-form-input 
                        name="chair_suffix" 
                        id="chair_suffix" 
                        placeholder="e.g., Jr., Sr., III" 
                        :value="old('chair_suffix')"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    />
                    <x-form-error name="chair_suffix" />
                </div>
            </div>

            <!-- Contact Number -->
            <div class="space-y-2">
                <label for="contact_no" class="text-sm text-gray-700">Contact Number (Required)</label>
                <x-form-input 
                    name="contact_no" 
                    id="contact_no" 
                    placeholder="Enter your contact number" 
                    :value="old('contact_no')" 
                    required
                    type="tel"
                    pattern="[0-9]{11}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                />
                <x-form-error name="contact_no" />
            </div>
        </div>

        <!-- Account Information Section -->
        <div class="space-y-4">
            <x-form-label class="text-lg font-semibold text-blue-900">Account Information</x-form-label>
            
            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="text-sm text-gray-700">Business Official Email (Required)</label>
                <x-form-input 
                    name="email" 
                    id="email" 
                    type="email" 
                    placeholder="Enter your business email" 
                    :value="old('email')" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                />
                <x-form-error name="email" />
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <label for="password" class="text-sm text-gray-700">Password (Required)</label>
                <x-form-input 
                    name="password" 
                    id="password" 
                    type="password" 
                    placeholder="Create a strong password" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                />
                <x-form-error name="password" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="password_confirmation" class="text-sm text-gray-700">Confirm Password (Required)</label>
                <x-form-input 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    type="password" 
                    placeholder="Confirm your password" 
                    required
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                />
                <x-form-error name="password_confirmation" />
            </div>
        </div>

        <!-- Form Actions -->
        <div class="flex justify-between pt-6">
            <x-cancel-button 
                onclick="closeModal('modalCreate'), resetForm('create_form')"
                class="px-4 py-2 text-gray-600 bg-gray-100 rounded-md hover:bg-gray-200 transition-colors"
            >
                Discard
            </x-cancel-button>
            
            <x-form-submit-button
                class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors"
            >
                Create Account
            </x-form-submit-button>
        </div>
    </div>
</form>
