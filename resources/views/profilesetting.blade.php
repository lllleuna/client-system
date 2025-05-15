@extends('layouts.layout')

@section('content')
    <div class="max-w-4xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
        @if (session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md shadow-sm"
                role="alert">
                <p>{{ session('success') }}</p>
            </div>
        @endif

        {{-- Profile Picture/Logo Card --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z"
                            clip-rule="evenodd" />
                    </svg>
                    Transportation Cooperative
                </h3>
            </div>
            <div class="px-4 py-8 flex flex-col items-center">
                <div class="relative group">
                    <img src="{{ $user->profile_picture ? asset('shared/uploads/' . $user->profile_picture) : asset('images/default.png') }}"
                        class="h-40 w-40 object-cover rounded-full ring-4 ring-black-400 shadow-md" alt="Cooperative Logo">
                    <div
                        class="absolute inset-0 rounded-full bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-opacity flex items-center justify-center">
                        <button
                            class="opacity-0 group-hover:opacity-100 transition-opacity bg-white text-gray-700 px-3 py-2 rounded-lg shadow text-sm font-medium"
                            type="button"
                            onclick="document.getElementById('editProfilePicModal').classList.remove('hidden')">
                            Change Logo
                        </button>
                    </div>
                </div>
                <h2 class="flex items-center mt-2 font-semibold space-x-2 py-2 uppercase text-2xl">
                    {{ Auth::user()->tc_name ?? 'Cooperative Chairperson' }}
                </h2>
            </div>
        </div>


        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Account Password
                </h3>
            </div>

            <form method="POST" action="{{ route('profile.updatePassword') }}" class="px-4 py-8 w-full">
                @csrf

                {{-- Current Password --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="current_password">Current Password</label>
                    <input type="password" name="current_password" id="current_password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                    @error('current_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- New Password --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700" for="new_password">New Password</label>
                    <input type="password" name="new_password" id="new_password" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200"
                        oninput="checkPasswordStrength()">
                    @error('new_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror

                    <ul class="mt-2 text-sm text-gray-600 space-y-1" id="password-requirements">
                        <li id="length" class="text-gray-500">• At least 12 characters</li>
                        <li id="uppercase" class="text-gray-500">• At least one uppercase letter</li>
                        <li id="lowercase" class="text-gray-500">• At least one lowercase letter</li>
                        <li id="number" class="text-gray-500">• At least one number</li>
                        <li id="symbol" class="text-gray-500">• At least one symbol (e.g., @, #, $, !)</li>
                    </ul>
                </div>

                {{-- Confirm New Password --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700" for="new_password_confirmation">Confirm New
                        Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200"
                        oninput="checkPasswordMatch()">
                    <p id="match-feedback" class="text-sm mt-1"></p>
                </div>

                {{-- Save Button --}}
                <div class="flex justify-center">
                    <button type="submit"
                        class="bg-indigo-600 w-full hover:bg-indigo-700 text-white font-medium px-5 py-2 rounded-lg transition duration-200">
                        Save
                    </button>
                </div>
            </form>
        </div>

        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-600" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                            clip-rule="evenodd" />
                    </svg>
                    Setup 2-Factor Authentication
                </h3>
            </div>

            <div class="px-6 py-5">
                <div class="flex flex-col space-y-6">
                    <!-- Phone Verification Status -->
                    <div class="bg-gray-50 rounded-lg p-4 flex justify-between items-center">
                        <div class="flex flex-col">
                            <h4 class="text-sm font-medium text-gray-500">Business Contact Number</h4>
                            <div class="flex items-center mt-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-gray-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path
                                        d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                </svg>
                                <span class="text-gray-900 font-medium">0{{ auth()->user()->contact_no }}</span>
                            </div>
                        </div>

                        @if (auth()->user()->contact_no_verified_at)
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                <svg class="mr-1.5 h-3 w-3 text-green-600" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Verified
                            </span>
                        @else
                            <span
                                class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                <svg class="mr-1.5 h-3 w-3 text-red-600" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                Not Verified
                            </span>
                        @endif
                    </div>

                    <!-- 2FA Status -->
                    <div class="flex flex-col items-center space-y-5 py-4">
                        <div class="flex items-center justify-center w-16 h-16 rounded-full bg-gray-100">
                            @if ($user->two_factor_enabled)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-gray-400" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            @endif
                        </div>

                        <div class="text-center">
                            <p class="text-sm text-gray-600 mb-1">Two-Factor Authentication is currently:</p>
                            @if ($user->two_factor_enabled)
                                <p class="text-green-600 font-semibold text-lg">Enabled</p>
                            @else
                                <p class="text-red-600 font-semibold text-lg">Disabled</p>
                            @endif
                        </div>

                        <button onclick="document.getElementById('twofaModal').showModal()"
                            class="mt-4 inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200
                                {{ $user->two_factor_enabled
                                    ? 'bg-red-600 hover:bg-red-700 focus:ring-red-500'
                                    : 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500' }}">
                            @if ($user->two_factor_enabled)
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd" />
                                </svg>
                                Disable 2FA
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Enable 2FA
                            @endif
                        </button>
                    </div>
                </div>
            </div>

            <div class="bg-gray-50 px-6 py-4 border-t border-gray-200">
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-xs text-gray-500">
                            Two-factor authentication adds an extra layer of security to your account. Once enabled, you'll
                            need to provide a verification code sent to your phone in addition to your password when signing
                            in.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <dialog id="twofaModal" class="rounded-lg shadow-lg p-4 w-96">
            <form method="POST" action="{{ route('profile.toggle2fa') }}">
                @csrf
                <h3 class="text-lg font-semibold mb-4">Confirm Password</h3>
                <p class="text-sm text-gray-600 mb-2">Please enter your password to continue.</p>

                <input type="password" name="password" required
                    class="w-full px-3 py-2 border rounded mb-4 focus:outline-none focus:ring focus:border-blue-300">
                @if ($errors->has('password'))
                    <p class="text-sm text-red-600 mt-2">{{ $errors->first('password') }}</p>
                @endif

                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="document.getElementById('twofaModal').close()"
                        class="px-3 py-1 rounded bg-gray-300 text-sm">Cancel</button>
                    <button type="submit" class="px-3 py-1 rounded bg-blue-600 text-white text-sm">Confirm</button>
                </div>
            </form>
        </dialog>

    </div>

    {{-- Modal: Edit Profile Picture --}}
    <div id="editProfilePicModal" class="hidden fixed inset-0 overflow-y-auto z-50">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div class="fixed inset-0 transition-opacity" aria-hidden="true">
                <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
            </div>

            <!-- This element is to trick the browser into centering the modal contents. -->
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <form action="{{ route('profile.updatePicture') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="bg-white">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <h3 class="text-lg font-medium text-gray-900">Change Cooperative Logo</h3>
                        </div>
                        <div class="p-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Upload new logo</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">
                                    <!-- Image preview container -->
                                    <img id="image-preview" class="mx-auto h-24 w-24 object-cover rounded-full hidden" />

                                    <!-- Icon (visible before selection) -->
                                    <svg id="upload-icon" class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                        fill="none" viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>

                                    <!-- Upload label -->
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="profile_picture" type="file"
                                                class="sr-only" accept="image/png, image/jpeg" required>
                                        </label>
                                    </div>

                                    <!-- File size note -->
                                    <p class="text-xs text-gray-500">PNG, JPG up to 2MB</p>

                                    <!-- JS error message -->
                                    <p id="file-error" class="text-red-500 text-sm mt-1 hidden"></p>
                                </div>
                            </div>
                        </div>
                        <div class="px-6 py-4 bg-gray-50 flex justify-end space-x-3">
                            <button type="button"
                                class="inline-flex justify-center py-2 px-4 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                onclick="document.getElementById('editProfilePicModal').classList.add('hidden')">
                                Cancel
                            </button>
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function checkPasswordStrength() {
            const password = document.getElementById('new_password').value;

            const length = password.length >= 12;
            const uppercase = /[A-Z]/.test(password);
            const lowercase = /[a-z]/.test(password);
            const number = /[0-9]/.test(password);
            const symbol = /[!@#$%^&*(),.?":{}|<>]/.test(password);

            // Update requirement UI
            document.getElementById('length').className = length ? 'text-green-600' : 'text-gray-500';
            document.getElementById('uppercase').className = uppercase ? 'text-green-600' : 'text-gray-500';
            document.getElementById('lowercase').className = lowercase ? 'text-green-600' : 'text-gray-500';
            document.getElementById('number').className = number ? 'text-green-600' : 'text-gray-500';
            document.getElementById('symbol').className = symbol ? 'text-green-600' : 'text-gray-500';

            // Also re-check password match when new_password changes
            checkPasswordMatch();
        }

        function checkPasswordMatch() {
            const password = document.getElementById('new_password').value;
            const confirm = document.getElementById('new_password_confirmation').value;
            const feedback = document.getElementById('match-feedback');

            if (!confirm) {
                feedback.textContent = '';
                return;
            }

            if (password === confirm) {
                feedback.textContent = '✔ Passwords match';
                feedback.className = 'text-green-600 text-sm mt-1';
            } else {
                feedback.textContent = '✘ Passwords do not match';
                feedback.className = 'text-red-600 text-sm mt-1';
            }
        }

        document.getElementById('file-upload').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const maxSizeMB = 2;
            const errorElement = document.getElementById('file-error');
            const preview = document.getElementById('image-preview');
            const uploadIcon = document.getElementById('upload-icon');

            if (file) {
                if (file.size > maxSizeMB * 1024 * 1024) {
                    errorElement.textContent = `File exceeds ${maxSizeMB}MB limit.`;
                    errorElement.classList.remove('hidden');
                    preview.classList.add('hidden');
                    uploadIcon.classList.remove('hidden');
                    e.target.value = ''; // clear input
                } else {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        preview.src = event.target.result;
                        preview.classList.remove('hidden');
                        uploadIcon.classList.add('hidden');
                        errorElement.classList.add('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            const modal = document.getElementById('editProfilePicModal');
            if (event.target === modal) {
                modal.classList.add('hidden');
            }
        });

        // Close modal with escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                document.getElementById('editProfilePicModal').classList.add('hidden');
            }
        });
    </script>
@endsection
