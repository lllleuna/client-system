@extends('layouts.layout')

@section('content')

<div class="container mx-auto px-4 py-8">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-2xl font-bold text-gray-900 mb-8">Profile Settings</h1>
            
            <!-- Profile Information Section -->
            <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Profile Information</h2>
                <form x-data="{ photoPreview: null }">
                    <!-- Logo Upload -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Company Logo</label>
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
                                    <input type="file" class="hidden" accept="image/*"
                                        @change="const file = $event.target.files[0]; 
                                                const reader = new FileReader();
                                                reader.onload = (e) => { photoPreview = e.target.result };
                                                reader.readAsDataURL(file)">
                                </label>
                                <p class="text-sm text-gray-500 mt-1">PNG, JPG up to 2MB</p>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Details -->
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" placeholder="#"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Contact Number</label>
                            <input type="tel" placeholder="#"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Password Change Section -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="text-xl font-semibold text-gray-800 mb-4">Change Password</h2>
                <form>
                    <div class="grid grid-cols-1 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Current Password</label>
                            <input type="password" placeholder="Enter current password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">New Password</label>
                            <input type="password" placeholder="Enter new password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Confirm New Password</label>
                            <input type="password" placeholder="Confirm new password"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
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
@endsection