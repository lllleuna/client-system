@extends('layouts.layout')

@section('content')

<div class="container mx-auto px-4 py-8">
    <div class="max-w-3xl mx-auto">
        <h1 class="text-2xl font-bold text-gray-900 mb-8">Profile Settings</h1>
        
        <!-- Profile Information Section -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Profile Information</h2>
            <form x-data="{ photoPreview: null }" @submit.prevent="validateProfileForm()">
                <!-- Logo Upload -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cooperative Logo <span class="text-red-500">*</span></label>
                    <div class="flex items-center">
                        <div class="w-24 h-24 rounded-lg border-2 border-gray-300 flex items-center justify-center overflow-hidden">
                            <template x-if="!photoPreview">
                                <img src="{{ asset('images/rizalCoop.png') }}" alt="Current logo" class="w-full h-full object-cover">
                            </template>
                            <template x-if="photoPreview">
                                <img :src="photoPreview" alt="New logo preview" class="w-full h-full object-cover">
                            </template>
                        </div>
                        <div class="ml-4">
                            <label class="cursor-pointer bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Upload New Logo
                                <input type="file" name="logo" id="logo" class="hidden" accept="image/*"
                                    @change="const file = $event.target.files[0]; 
                                            if(file && file.size <= 2 * 1024 * 1024) {
                                                const reader = new FileReader();
                                                reader.onload = (e) => { photoPreview = e.target.result };
                                                reader.readAsDataURL(file);
                                                document.getElementById('logo-error').textContent = '';
                                            } else {
                                                document.getElementById('logo-error').textContent = 'File size must be less than 2MB';
                                                $event.target.value = '';
                                            }">
                            </label>
                            <p class="text-sm text-gray-500 mt-1">PNG, JPG up to 2MB</p>
                            <p id="logo-error" class="text-sm text-red-500 mt-1"></p>
                        </div>
                    </div>
                </div>

                <!-- Chairperson Details -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">First Name <span class="text-red-500">*</span></label>
                        <input type="text" name="first_name" id="first_name" value="{{ Auth::user()->chair_fname}}" placeholder="First Name" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="first-name-error" class="text-sm text-red-500 mt-1"></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" placeholder="Middle Name"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Surname <span class="text-red-500">*</span></label>
                        <input type="text" name="surname" id="surname" placeholder="Surname" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="surname-error" class="text-sm text-red-500 mt-1"></p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Birthdate <span class="text-red-500">*</span></label>
                        <input type="date" name="birthdate" id="birthdate" required
                            max="{{ date('Y-m-d', strtotime('-18 years')) }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="birthdate-error" class="text-sm text-red-500 mt-1"></p>
                        <p class="text-sm text-gray-500 mt-1">Must be at least 18 years old</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" name="email" id="email" placeholder="example@email.com" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="email-error" class="text-sm text-red-500 mt-1"></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number <span class="text-red-500">*</span></label>
                        <input type="tel" name="contact_number" id="contact_number" placeholder="+639xxxxxxxxx" required
                            pattern="^\+?[0-9]{10,15}$"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="contact-error" class="text-sm text-red-500 mt-1"></p>
                        <p class="text-sm text-gray-500 mt-1">Enter a valid phone number (10-15 digits)</p>
                    </div>
                </div>

                <div class="flex justify-end mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        <!-- Password Change Section -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Change Password</h2>
            <form x-data="{}" @submit.prevent="validatePasswordForm()">
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Password <span class="text-red-500">*</span></label>
                        <input type="password" name="current_password" id="current_password" placeholder="Enter current password" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="current-password-error" class="text-sm text-red-500 mt-1"></p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Password <span class="text-red-500">*</span></label>
                        <input type="password" name="new_password" id="new_password" 
                            placeholder="Enter new password" required
                            minlength="8"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="new-password-error" class="text-sm text-red-500 mt-1"></p>
                        <p class="text-sm text-gray-500 mt-1">Minimum 12 characters, including uppercase, lowercase, number and special character</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password <span class="text-red-500">*</span></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" 
                            placeholder="Confirm new password" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <p id="confirm-password-error" class="text-sm text-red-500 mt-1"></p>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                            Update Password
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function validateProfileForm() {
        let isValid = true;
        
        // First Name validation
        const firstName = document.getElementById('first_name');
        if (!firstName.value.trim()) {
            document.getElementById('first-name-error').textContent = 'First name is required';
            isValid = false;
        } else if (!/^[A-Za-z\s]+$/.test(firstName.value.trim())) {
            document.getElementById('first-name-error').textContent = 'First name should contain only letters';
            isValid = false;
        } else {
            document.getElementById('first-name-error').textContent = '';
        }
        
        // Surname validation
        const surname = document.getElementById('surname');
        if (!surname.value.trim()) {
            document.getElementById('surname-error').textContent = 'Surname is required';
            isValid = false;
        } else if (!/^[A-Za-z\s]+$/.test(surname.value.trim())) {
            document.getElementById('surname-error').textContent = 'Surname should contain only letters';
            isValid = false;
        } else {
            document.getElementById('surname-error').textContent = '';
        }
        
        // Birthdate validation
        const birthdate = document.getElementById('birthdate');
        if (!birthdate.value) {
            document.getElementById('birthdate-error').textContent = 'Birthdate is required';
            isValid = false;
        } else {
            const birthdateValue = new Date(birthdate.value);
            const today = new Date();
            const minDate = new Date();
            minDate.setFullYear(today.getFullYear() - 18);
            
            if (birthdateValue > minDate) {
                document.getElementById('birthdate-error').textContent = 'Must be at least 18 years old';
                isValid = false;
            } else {
                document.getElementById('birthdate-error').textContent = '';
            }
        }
        
        // Email validation
        const email = document.getElementById('email');
        if (!email.value.trim()) {
            document.getElementById('email-error').textContent = 'Email is required';
            isValid = false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            document.getElementById('email-error').textContent = 'Please enter a valid email address';
            isValid = false;
        } else {
            document.getElementById('email-error').textContent = '';
        }
        
        // Contact number validation
        const contactNumber = document.getElementById('contact_number');
        if (!contactNumber.value.trim()) {
            document.getElementById('contact-error').textContent = 'Contact number is required';
            isValid = false;
        } else if (!/^\+?[0-9]{10,15}$/.test(contactNumber.value.trim())) {
            document.getElementById('contact-error').textContent = 'Please enter a valid phone number (10-15 digits)';
            isValid = false;
        } else {
            document.getElementById('contact-error').textContent = '';
        }
        
        if (isValid) {
            // Submit the form if validation passes
            alert('Profile information updated successfully!');
            // You would normally submit the form here
        }
        
        return isValid;
    }
    
    function validatePasswordForm() {
        let isValid = true;
        
        // Current password validation
        const currentPassword = document.getElementById('current_password');
        if (!currentPassword.value) {
            document.getElementById('current-password-error').textContent = 'Current password is required';
            isValid = false;
        } else {
            document.getElementById('current-password-error').textContent = '';
        }
        
        // New password validation
        const newPassword = document.getElementById('new_password');
        if (!newPassword.value) {
            document.getElementById('new-password-error').textContent = 'New password is required';
            isValid = false;
        } else if (newPassword.value.length < 12) {
            document.getElementById('new-password-error').textContent = 'Password must be at least 12 characters long';
            isValid = false;
        } else if (!/(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[!@#$%^&*])/.test(newPassword.value)) {
            document.getElementById('new-password-error').textContent = 'Password must include uppercase, lowercase, number and special character';
            isValid = false;
        } else {
            document.getElementById('new-password-error').textContent = '';
        }
        
        // Confirm password validation
        const confirmPassword = document.getElementById('password_confirmation');
        if (!confirmPassword.value) {
            document.getElementById('confirm-password-error').textContent = 'Please confirm your password';
            isValid = false;
        } else if (confirmPassword.value !== newPassword.value) {
            document.getElementById('confirm-password-error').textContent = 'Passwords do not match';
            isValid = false;
        } else {
            document.getElementById('confirm-password-error').textContent = '';
        }
        
        if (isValid) {
            // Submit the form if validation passes
            alert('Password updated successfully!');
            // You would normally submit the form here
        }
        
        return isValid;
    }
</script>
@endsection