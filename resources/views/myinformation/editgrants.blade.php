@extends('layouts.layout')

@section('content')
    <div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6">

                {{-- Sidebar  --}}
                @include('components.sidebar')

                {{-- Main Content --}}
                <div class="col-span-9">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-2xl font-bold text-gray-800">Add Acquisition Details</h2>
                            <a href="#" class="text-gray-500 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </div>

                        <form action="{{ $mode == 'edit' ? route('grant.update', $grant->id) : route('addGrant') }}"
                            method="POST" enctype="multipart/form-data" class="space-y-6">
                            @csrf
                            @if ($mode == 'edit')
                                @method('PUT')
                            @endif

                            <div class="space-y-6">
                                {{-- Date Acquired --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Date Acquired <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" name="date_acquired"
                                        value="{{ old('date_acquired', $grant->date_acquired ?? '') }}"
                                        max="{{ \Carbon\Carbon::today()->format('Y-m-d') }}"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('date_acquired') border-red-500 @enderror"
                                        required>
                                    @error('date_acquired')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>


                                {{-- Amount --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Amount <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" step="0.01" name="amount"
                                        value="{{ old('amount', $grant->amount ?? '') }}"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('amount') border-red-500 @enderror"
                                        placeholder="Enter amount" required>
                                    @error('amount')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16V4h10v12M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Upload File <span class="text-red-500">*</span>
                                    </label>

                                    @if (isset($grant) && $grant->file_upload)
                                        <!-- If a file is already uploaded, show the file name and a link to download -->
                                        <div class="mb-2">
                                            <label class="text-sm font-medium text-gray-700">Current File:</label>
                                            <p class="text-sm text-gray-600">
                                                <a href="{{ asset('storage/' . $grant->file_upload) }}" target="_blank"
                                                    class="text-blue-500 hover:underline">
                                                    {{ basename($grant->file_upload) }}
                                                </a>
                                            </p>
                                            <p class="text-sm text-gray-600">Click to view or download the current file.</p>
                                        </div>
                                    @endif

                                    <input type="file" name="file_upload"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('file_upload') border-red-500 @enderror">

                                    @error('file_upload')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>


                                {{-- Source --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Source <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="source" value="{{ old('source', $grant->source ?? '') }}"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('source') border-red-500 @enderror"
                                        placeholder="Enter source" required>
                                    @error('source')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Status/Remarks --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        Status/Remarks
                                    </label>
                                    <textarea name="status_remarks" rows="3"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('remarks') border-red-500 @enderror"
                                        placeholder="Enter status or remarks">{{ old('remarks', $grant->status_remarks ?? '') }}</textarea>
                                    @error('status_remarks')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                                <a href="{{ route('grants') }}"
                                    class="px-6 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 border border-gray-300 transition-all duration-200">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="px-6 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200">
                                    Save Acquisition
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
