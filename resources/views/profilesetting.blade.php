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
            <div class="bg-gray-50 px-4 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Cooperative Logo</h3>
            </div>
            <div class="px-4 py-8 flex flex-col items-center">
                <div class="relative group">
                    <img src="{{ $user->profile_picture ? asset('shared/uploads/' . $user->profile_picture) : asset('images/default.png') }}"
                        class="h-40 w-40 object-cover rounded-full ring-4 ring-gray-100 shadow-md" alt="Cooperative Logo">
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

                <button
                    class="mt-6 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                    type="button" onclick="document.getElementById('editProfilePicModal').classList.remove('hidden')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                    </svg>
                    Update Logo
                </button>
            </div>
        </div>


        <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
            <div class="bg-gray-50 px-4 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Account Security</h3>
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
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
                    @error('new_password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Confirm New Password --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700" for="new_password_confirmation">Confirm New
                        Password</label>
                    <input type="password" name="new_password_confirmation" id="new_password_confirmation" required
                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200">
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
            <div class="bg-gray-50 px-4 py-5 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">Setup 2-Factor Authentication</h3>
            </div>

            <div class="flex flex-col">
                <h3 class="font-semibold">Business Contact No.</h3>
                <h3>0{{ auth()->user()->contact_no }}</h3>

                @if (auth()->user()->contact_no_verified_at)
                    <span class="text-green-600 font-semibold">Verified</span>
                @else
                    <span class="text-red-600 font-semibold">Not Verified</span>
                @endif
            </div>

            <div class="px-4 py-8 flex flex-col items-center space-y-4">
                <p class="text-gray-700 text-sm">
                    Two-Factor Authentication is:
                    @if ($user->two_factor_enabled)
                        <span class="text-green-600 font-semibold">Enabled</span>
                    @else
                        <span class="text-red-600 font-semibold">Disabled</span>
                    @endif
                </p>

                <button onclick="document.getElementById('twofaModal').showModal()"
                    class="px-4 py-2 rounded-lg text-white 
                            {{ $user->two_factor_enabled ? 'bg-red-500 hover:bg-red-600' : 'bg-blue-500 hover:bg-blue-600' }}">
                    {{ $user->two_factor_enabled ? 'Disable 2FA' : 'Enable 2FA' }}
                </button>
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
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload"
                                            class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Upload a file</span>
                                            <input id="file-upload" name="profile_picture" type="file"
                                                class="sr-only" accept="image/png, image/jpeg" required>
                                        </label>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG up to 10MB</p>
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
