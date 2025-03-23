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
                            <h2 class="text-2xl font-bold text-gray-800">Manage Business Details</h2>
                            <a href="#" class="text-gray-500 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </div>

                        <form
                            action="{{ $mode == 'edit' ? route('business.update', $business->id) : route('addbusiness') }}"
                            method="POST" class="space-y-6">
                            @csrf
                            @if ($mode == 'edit')
                                @method('PUT')
                            @endif

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                {{-- Business Type --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        Type <span class="text-red-500">*</span>
                                    </label>
                                    <div class="flex space-x-4">
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="type" class="mr-2" value="Existing"
                                                {{ old('type', $business->type ?? '') === 'Existing' ? 'checked' : '' }}
                                                required>
                                            <span>Existing</span>
                                        </label>
                                        <label class="inline-flex items-center">
                                            <input type="radio" name="type" class="mr-2" value="Proposed"
                                                {{ old('type', $business->type ?? '') === 'Proposed' ? 'checked' : '' }}
                                                required>
                                            <span>Proposed</span>
                                        </label>
                                    </div>
                                    @error('type')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>


                                {{-- Years of Existence --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Years of Existence <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" name="years_of_existence"
                                        value="{{ old('years_of_existence', $business->years_of_existence ?? '') }}"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('years_existence') border-red-500 @enderror"
                                        placeholder="Enter number of years" required>
                                    @error('years_of_existence')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Starting Capital --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Starting Capital <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" step="0.01" name="starting_capital"
                                        value="{{ old('starting_capital', $business->starting_capital ?? '') }}"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('starting_capital') border-red-500 @enderror"
                                        placeholder="Enter starting capital amount" required>
                                    @error('starting_capital')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Capital to Date --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        Capital to Date <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" step="0.01" name="capital_to_date"
                                        value="{{ old('capital_to_date', $business->capital_to_date ?? '') }}"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('capital_to_date') border-red-500 @enderror"
                                        placeholder="Enter current capital amount" required>
                                    @error('capital_to_date')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-6">
                                {{-- Nature of Business --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        Nature of Business <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="nature_of_business" rows="3"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('nature_of_business') border-red-500 @enderror"
                                        placeholder="Describe the nature of the business" required>{{ old('nature_of_business', $business->nature_of_business ?? '') }}</textarea>
                                    @error('nature_of_business')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Status (Comment) --}}
                                <div>
                                    <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                        <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                        Status (Comment) <span class="text-red-500">*</span>
                                    </label>
                                    <textarea name="remarks" rows="3"
                                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('status_comment') border-red-500 @enderror"
                                        placeholder="E.g. NON-OPERATIONAL, OPERATIONAL, EXISTING, ACTIVE, ON-GOING">{{ old('remarks', $business->remarks ?? '') }}</textarea>
                                    @error('remarks')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                            </div>

                            <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                                <a href="{{ route('businesses') }}"
                                    class="px-6 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 border border-gray-300 transition-all duration-200">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="px-6 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200">
                                    Save Business
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
