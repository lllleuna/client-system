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

            <form action="/users/create" method="POST" id="create_form"
                class="bg-white shadow-2xl rounded-xl overflow-hidden border border-gray-100">
                @csrf

                <div class="bg-blue-900 px-6 py-4">
                    <x-form-title class="text-2xl font-bold text-white flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Account Creation
                    </x-form-title>
                </div>

                <div class="alert alert-info p-3 rounded-lg shadow-md bg-blue-100 border-l-4 border-blue-500 text-blue-800">
                    <strong>Reminder:</strong> A valid <strong>CDA Registration Number</strong> is required to create an account and conduct transactions with the Office of Transportation Cooperative. Please ensure that your cooperative is registered with the <strong>Cooperative Development Authority (CDA)</strong>.
                </div>                

                <div class="p-6 space-y-8">
                    <!-- Business Information Section -->
                    <div class="space-y-4 bg-white rounded-lg p-5 shadow-sm border border-gray-100">
                        <x-form-label
                            class="text-xl font-semibold text-gray-700 border-b border-gray-200 pb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1 text-blue-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z"
                                    clip-rule="evenodd" />
                            </svg>
                            Business Information
                        </x-form-label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cda_reg_no" class="block text-sm font-medium text-gray-600 mb-1">
                                    CDA Registration No.
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">T-</span>
                                    </div>
                                    <x-form-input name="cda_reg_no" id="cda_reg_no" placeholder="20230891" :value="old('cda_reg_no')"
                                        pattern="^\d{8}$" title="Enter an 8-digit number (e.g., 12345678)"
                                        class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                        required maxlength="8" />
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Format: XXXXXXXX (e.g., 20230891)</p>
                                <x-form-error name="cda_reg_no" bag="signup" class="text-red-500 text-xs mt-1" />
                            </div>

                            <div>
                                <label for="tc_name" class="block text-sm font-medium text-gray-600 mb-1">Transport
                                    Cooperative Name</label>
                                <x-form-input name="tc_name" id="tc_name" placeholder="Enter cooperative name"
                                    :value="old('tc_name')"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                    required />
                                <x-form-error name="tc_name" bag="signup" class="text-red-500 text-xs mt-1" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="contact_no" class="block text-sm font-medium text-gray-600 mb-1">
                                    Office Contact Number
                                </label>
                                <div class="relative" title="Format: 10 digits Only (e.g., 9123456789)">
                                    <div class="absolute inset-y-0 left-0 pl-2 flex items-center pointer-events-none">
                                        <span class="text-gray-500 ml-2 sm:text-sm">+63</span>
                                    </div>
                                    <x-form-input name="contact_no" id="contact_no" placeholder="(e.g, 9123456789)"
                                        :value="old('contact_no')" pattern="^\d{10}$" title="Enter 10 digits only (e.g., 9123456789)"
                                        maxlength="10"
                                        class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                        required />
                                </div>
                                <p class="text-xs text-gray-500 mt-1">
                                    Format: 10 digits Only (e.g., 9123456789).
                                </p>
                                <x-form-error name="contact_no" bag="signup" class="text-red-500 text-xs mt-1" />
                            </div>
                        </div>
                    </div>

                    <!-- Chairperson's Information Section -->
                    <div class="space-y-4 bg-white rounded-lg p-5 shadow-sm border border-gray-100">
                        <x-form-label
                            class="text-xl font-semibold text-gray-700 border-b border-gray-200 pb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1 text-blue-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd" />
                            </svg>
                            Cooperative Chairperson's Information
                        </x-form-label>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="chair_fname" class="block text-sm font-medium text-gray-600 mb-1">First
                                    Name</label>
                                <x-form-input name="chair_fname" id="chair_fname" placeholder="First name" :value="old('chair_fname')"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                    required />
                                <x-form-error name="chair_fname" bag="signup" class="text-red-500 text-xs mt-1" />
                            </div>

                            <div>
                                <label for="chair_mname" class="block text-sm font-medium text-gray-600 mb-1">Middle Name
                                    <span class="text-gray-400">(optional)</span></label>
                                <x-form-input name="chair_mname" id="chair_mname" placeholder="Middle name"
                                    :value="old('chair_mname')"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" />
                                <x-form-error name="chair_mname" bag="signup" class="text-red-500 text-xs mt-1" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="chair_lname" class="block text-sm font-medium text-gray-600 mb-1">Last
                                    Name</label>
                                <x-form-input name="chair_lname" id="chair_lname" placeholder="Last name"
                                    :value="old('chair_lname')"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                    required />
                                <x-form-error name="chair_lname" bag="signup" class="text-red-500 text-xs mt-1" />
                            </div>

                            <div>
                                <label for="chair_suffix" class="block text-sm font-medium text-gray-600 mb-1">Suffix
                                    <span class="text-gray-400">(optional)</span></label>
                                <x-form-input name="chair_suffix" id="chair_suffix" placeholder="e.g., Jr., Sr., III"
                                    :value="old('chair_suffix')"
                                    class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" />
                                <x-form-error name="chair_suffix" bag="signup" class="text-red-500 text-xs mt-1" />
                            </div>
                        </div>

                    </div>

                    <!-- Account Information Section -->
                    <div class="space-y-4 bg-white rounded-lg p-5 shadow-sm border border-gray-100">
                        <x-form-label
                            class="text-xl font-semibold text-gray-700 border-b border-gray-200 pb-2 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block mr-1 text-blue-600"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z"
                                    clip-rule="evenodd" />
                            </svg>
                            Account Information
                        </x-form-label>

                        <div class="space-y-4">
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-600 mb-1">Business
                                    Official Email</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                                        </svg>
                                    </div>
                                    <x-form-input name="email" id="email" type="email"
                                        placeholder="name@company.com" :value="old('email')"
                                        class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                        required oninput="validateEmail(this)" onblur="validateEmail(this, true)" />
                                </div>
                                <div id="email-error" class="text-red-500 text-xs mt-1 hidden">Please include an @ in the
                                    email address</div>
                                <x-form-error name="email" bag="signup" class="text-red-500 text-xs mt-1" />
                            </div>

                            {{-- Password --}}
                            <div>
                                <label for="password"
                                    class="block text-sm font-medium text-gray-600 mb-1">Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <x-form-input name="password" id="password" type="password"
                                        placeholder="••••••••••••"
                                        class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                        required />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button" id="togglePassword"
                                            class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor" id="eyeIcon">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden"
                                                viewBox="0 0 20 20" fill="currentColor" id="eyeSlashIcon">
                                                <path fill-rule="evenodd"
                                                    d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                                    clip-rule="evenodd" />
                                                <path
                                                    d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-2 space-y-2">
                                    <p class="text-sm font-medium text-gray-700">Password must contain:</p>
                                    <div class="grid grid-cols-1 gap-1">
                                        <div id="length-check" class="flex items-center text-xs text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            At least 12 characters
                                        </div>
                                        <div id="uppercase-check" class="flex items-center text-xs text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            At least 1 capital letter
                                        </div>
                                        <div id="special-check" class="flex items-center text-xs text-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            At least 1 special character
                                        </div>
                                    </div>
                                </div>
                                <x-form-error name="password" bag="signup" class="text-red-500 text-xs mt-1" />
                            </div>

                            {{-- Confirm Password --}}
                            <div class="mt-4">
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-600 mb-1">Confirm Password</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                    <x-form-input name="password_confirmation" id="password_confirmation" type="password"
                                        placeholder="••••••••••••"
                                        class="pl-10 w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm"
                                        required />
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                                        <button type="button" id="toggleConfirmPassword"
                                            class="text-gray-400 hover:text-gray-600 focus:outline-none">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor" id="confirmEyeIcon">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 hidden"
                                                viewBox="0 0 20 20" fill="currentColor" id="confirmEyeSlashIcon">
                                                <path fill-rule="evenodd"
                                                    d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z"
                                                    clip-rule="evenodd" />
                                                <path
                                                    d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <div id="match-check" class="flex items-center text-xs text-red-500 mt-1 hidden">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Passwords match
                                </div>
                                <x-form-error name="password_confirmation" bag="signup"
                                    class="text-red-500 text-xs mt-1" />
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


        </div>
    </div>

    <script>
        // ID Input Masking
        function setIdInputMask() {
            const idType = document.getElementById('id_type').value;
            const idNumberInput = document.getElementById('id_number');
            const formatHint = document.getElementById('id_format_hint');

            // Clear previous input
            idNumberInput.value = '';
            idNumberInput.removeAttribute('pattern');
            idNumberInput.removeAttribute('title');

            // Define validation patterns for each ID type
            const validationRules = {
                passport: {
                    // Letter followed by 8 digits for Philippine passport
                    pattern: '^[A-Z][0-9]{8}$',
                    title: 'Format: Letter followed by 8 digits (e.g., P12345678)',
                    hint: 'Format: Letter followed by 8 digits (e.g., P12345678)',
                    maxLength: 9
                },
                sss: {
                    pattern: '^[0-9]{2}-[0-9]{7}-[0-9]$',
                    title: 'Format: 12-3456789-0',
                    hint: 'Format: 12-3456789-0 (include hyphens)',
                    maxLength: 12
                },
                gsis: {
                    pattern: '^[0-9]{11}$',
                    title: 'Format: 11 digits (e.g., 12345678901)',
                    hint: 'Format: 11 digits (e.g., 12345678901)',
                    maxLength: 11
                },
                umid: {
                    pattern: '^[0-9]{12}$',
                    title: 'Format: 12 digits (e.g., 123456789012)',
                    hint: 'Format: 12 digits (e.g., 123456789012)',
                    maxLength: 12
                },
                driver_license: {
                    // Support both new (A12-345678) and old formats (N12345678)
                    pattern: '^([A-Z]{1}[0-9]{2}-[0-9]{6}|[A-Z0-9][0-9]{8})$',
                    title: 'Format: A12-345678 (New) or N12345678 (Old)',
                    hint: 'Format: A12-345678 (New) or N12345678 (Old)',
                    maxLength: 10
                },
                prc: {
                    pattern: '^[0-9]{7}$',
                    title: 'Format: 7 digits (e.g., 1234567)',
                    hint: 'Format: 7 digits (e.g., 1234567)',
                    maxLength: 7
                }
            };

            if (validationRules[idType]) {
                const rule = validationRules[idType];

                // Set input constraints
                idNumberInput.setAttribute('pattern', rule.pattern);
                idNumberInput.setAttribute('title', rule.title);
                idNumberInput.setAttribute('maxlength', rule.maxLength);
                formatHint.textContent = rule.hint;

                // Add real-time validation without automatic formatting
                idNumberInput.addEventListener('input', function(e) {
                    // Show visual validation feedback
                    const isValid = new RegExp(rule.pattern).test(e.target.value);

                    if (e.target.value) {
                        if (!isValid) {
                            // Invalid input styling
                            e.target.classList.add('border-red-500');
                            e.target.classList.remove('border-green-500', 'border-gray-300');
                            formatHint.classList.add('text-red-500');
                            formatHint.classList.remove('text-green-500', 'text-gray-500');
                        } else {
                            // Valid input styling
                            e.target.classList.add('border-green-500');
                            e.target.classList.remove('border-red-500', 'border-gray-300');
                            formatHint.classList.add('text-green-500');
                            formatHint.classList.remove('text-red-500', 'text-gray-500');
                        }
                    } else {
                        // Empty input - return to default styling
                        e.target.classList.remove('border-red-500', 'border-green-500');
                        e.target.classList.add('border-gray-300');
                        formatHint.classList.remove('text-red-500', 'text-green-500');
                        formatHint.classList.add('text-gray-500');
                    }
                });
            } else {
                formatHint.textContent = 'Please select an ID type first';
            }

            checkFormValidity();
        }
        // Additional security measures for form submission
        function checkFormValidity() {
            const form = document.querySelector('form');
            const idType = document.getElementById('id_type');
            const idNumber = document.getElementById('id_number');

            // Add form submission validation
            form.addEventListener('submit', function(e) {
                let isValid = true;

                // Sanitize inputs to prevent XSS
                const sanitizedIdType = DOMPurify.sanitize(idType.value);
                const sanitizedIdNumber = DOMPurify.sanitize(idNumber.value);

                // Ensure ID type is selected and valid
                if (!sanitizedIdType || !['passport', 'sss', 'gsis', 'umid', 'driver_license', 'prc'].includes(
                        sanitizedIdType)) {
                    isValid = false;
                    showError(idType, 'Please select a valid ID type');
                } else {
                    removeError(idType);
                }

                // Validate ID number against the chosen pattern
                if (idNumber.getAttribute('pattern')) {
                    const pattern = new RegExp(idNumber.getAttribute('pattern'));
                    if (!pattern.test(sanitizedIdNumber)) {
                        isValid = false;
                        showError(idNumber, 'Please enter a valid ID number in the correct format');
                    } else {
                        removeError(idNumber);
                    }
                }

                if (!isValid) {
                    e.preventDefault();
                }
            });
        }

        // Helper functions for error handling
        function showError(element, message) {
            // Remove any existing error
            removeError(element);

            // Add error styling
            element.classList.add('border-red-500', 'bg-red-50');

            // Create and append error message
            const errorDiv = document.createElement('div');
            errorDiv.className = 'text-red-500 text-xs mt-1 error-message';
            errorDiv.textContent = message;
            element.parentNode.appendChild(errorDiv);
        }

        function removeError(element) {
            // Remove error styling
            element.classList.remove('border-red-500', 'bg-red-50');

            // Remove error message if exists
            const errorElement = element.parentNode.querySelector('.error-message');
            if (errorElement) {
                errorElement.remove();
            }
        }

        // Initialize validation on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Include DOMPurify for XSS protection
            if (typeof DOMPurify === 'undefined') {
                const script = document.createElement('script');
                script.src = 'https://cdnjs.cloudflare.com/ajax/libs/dompurify/2.4.0/purify.min.js';
                document.head.appendChild(script);
            }

            // Set up the initial form state
            setIdInputMask();
        });

        document.addEventListener("DOMContentLoaded", function() {
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
                submitButton.classList.add("bg-gradient-to-r", "from-blue-600", "to-indigo-700", "text-white",
                    "hover:from-blue-700", "hover:to-indigo-800", "shadow-lg", "hover:shadow-xl");
            } else {
                submitButton.disabled = true;
                submitButton.classList.remove("bg-gradient-to-r", "from-blue-600", "to-indigo-700", "text-white",
                    "hover:from-blue-700", "hover:to-indigo-800", "shadow-lg", "hover:shadow-xl");
                submitButton.classList.add("bg-gray-400", "cursor-not-allowed", "text-gray-700");
            }
        }

        // Attach event listeners to all required fields
        document.querySelectorAll("#create_form [required]").forEach(field => {
            field.addEventListener("input", checkFormValidity);
            field.addEventListener("change", checkFormValidity);
        });

        // CDA Input
        document.addEventListener("DOMContentLoaded", function() {
            const inputField = document.getElementById("cda_reg_no");

            inputField.addEventListener("input", function() {
                // Remove non-numeric characters
                this.value = this.value.replace(/\D/g, "").slice(0, 8);
            });

            inputField.form.addEventListener("submit", function() {
                // Ensure the input is sent with "T-" prefix
                inputField.value = "T-" + inputField.value;
            });
        });

        // Contact Number Input
        document.addEventListener("DOMContentLoaded", function() {
            const contactInput = document.getElementById("contact_no");

            contactInput.addEventListener("input", function() {
                // Remove non-numeric characters
                this.value = this.value.replace(/\D/g, '');

                // Limit to 10 digits
                if (this.value.length > 10) {
                    this.value = this.value.slice(0, 10);
                }
            });
        });

        // Password Strength Checker       
        document.addEventListener('DOMContentLoaded', function() {
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            const lengthCheck = document.getElementById('length-check');
            const uppercaseCheck = document.getElementById('uppercase-check');
            const specialCheck = document.getElementById('special-check');
            const matchCheck = document.getElementById('match-check');
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const eyeIcon = document.getElementById('eyeIcon');
            const eyeSlashIcon = document.getElementById('eyeSlashIcon');
            const confirmEyeIcon = document.getElementById('confirmEyeIcon');
            const confirmEyeSlashIcon = document.getElementById('confirmEyeSlashIcon');

            // Password validation function
            function validatePassword() {
                const password = passwordInput.value;

                // Check length
                if (password.length >= 12) {
                    lengthCheck.classList.remove('text-red-500');
                    lengthCheck.classList.add('text-green-500');
                } else {
                    lengthCheck.classList.remove('text-green-500');
                    lengthCheck.classList.add('text-red-500');
                    lengthCheck.textContent = "Password must be at least 12 characters long.";
                }

                // Check uppercase
                if (/[A-Z]/.test(password)) {
                    uppercaseCheck.classList.remove('text-red-500');
                    uppercaseCheck.classList.add('text-green-500');
                } else {
                    uppercaseCheck.classList.remove('text-green-500');
                    uppercaseCheck.classList.add('text-red-500');
                    uppercaseCheck.textContent = "Password must contain at least one capital letter.";
                }

                // Check special character
                if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password)) {
                    specialCheck.classList.remove('text-red-500');
                    specialCheck.classList.add('text-green-500');
                } else {
                    specialCheck.classList.remove('text-green-500');
                    specialCheck.classList.add('text-red-500');
                    specialCheck.textContent = "Password must contain at least one special character.";
                }

                // Check password match
                checkPasswordsMatch();
            }

            // Check if passwords match
            function checkPasswordsMatch() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;

                if (confirmPassword.length > 0) {
                    matchCheck.classList.remove('hidden');

                    if (password === confirmPassword) {
                        matchCheck.classList.remove('text-red-500');
                        matchCheck.classList.add('text-green-500');
                        matchCheck.textContent = "Passwords match";
                    } else {
                        matchCheck.classList.remove('text-green-500');
                        matchCheck.classList.add('text-red-500');
                        matchCheck.textContent = "Passwords do not match";
                    }
                } else {
                    matchCheck.classList.add('hidden');
                }
            }


            // Toggle password visibility
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                eyeIcon.classList.toggle('hidden');
                eyeSlashIcon.classList.toggle('hidden');
            });

            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                confirmEyeIcon.classList.toggle('hidden');
                confirmEyeSlashIcon.classList.toggle('hidden');
            });

            // Add event listeners
            passwordInput.addEventListener('input', validatePassword);
            confirmPasswordInput.addEventListener('input', checkPasswordsMatch);
        });
        //Email Validation
        function validateEmail(input, showError = false) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const errorElement = document.getElementById('email-error');
            const isValid = emailRegex.test(input.value);

            // Add/remove validity classes
            if (!isValid && (showError || input.value.length > 0)) {
                input.classList.add('border-red-500');
                input.classList.remove('border-gray-300', 'focus:border-blue-500');
                errorElement.classList.remove('hidden');
            } else {
                input.classList.remove('border-red-500');
                input.classList.add('border-gray-300', 'focus:border-blue-500');
                errorElement.classList.add('hidden');
            }

            return isValid;
        }

        // Form submission validation
        document.querySelector('form').addEventListener('submit', function(event) {
            const emailInput = document.getElementById('email');
            if (!validateEmail(emailInput, true)) {
                event.preventDefault();
            }
        });
    </script>
@endsection
