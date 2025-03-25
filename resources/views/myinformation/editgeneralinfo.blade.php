@extends('layouts.layout')

@section('content')
    <div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-12 gap-6">

                {{-- Sidebar --}}
                @include('components.sidebar')

                {{-- Enhanced Main Content --}}
                <div class="col-span-9">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center justify-between mb-8">
                            <h2 class="text-2xl font-bold text-gray-800">Edit General Information</h2>
                            <a href="#" class="text-gray-500 hover:text-gray-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </a>
                        </div>

                        <form action="{{ route('updategeneralinfo') }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            {{-- Basic Information Section --}}
                            <div class="p-4 bg-blue-50 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-blue-800 mb-4">Basic Information</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                            </svg>
                                            Name of TC (In Full) <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="tc_name"
                                            value="{{ old('tc_name', $externalUser->tc_name ?? '') }}"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('name') border-red-500 @enderror"
                                            placeholder="Enter TC name" required>
                                        @error('tc_name')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                            </svg>
                                            Business Address <span class="text-red-500">*</span>
                                            <h5 class="text-gray-400">House/Lot No. Block/Street</h5>
                                        </label>
                                    
                                        <!-- Business Address -->
                                        <input type="text" name="business_address"
                                            value="{{ old('business_address', $generalInfo->business_address ?? '') }}"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                            placeholder="Enter business address" required>
                                    
                                    </div>

                                

                                    <div>
                                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                            Official Email Address <span class="text-red-500">*</span>
                                        </label>
                                        <input type="email" name="email"
                                            value="{{ old('email', $externalUser->email ?? '') }}"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('email') border-red-500 @enderror"
                                            placeholder="Enter email address" required>
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                            Official Contact Number <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="contact_no"
                                            type="tel"
                                            name="contact_no"
                                            value="{{ old('contact_no', $externalUser->contact_no ?? '') }}"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('mobile_no') border-red-500 @enderror"
                                            placeholder="9XXXXXXXXX"
                                            pattern="9\d{9}"
                                            maxlength="10"
                                            required
                                            oninvalid="this.setCustomValidity('Please enter a valid 10-digit phone number starting with 9')"
                                            oninput="this.setCustomValidity('')"
                                            onkeypress="if(event.key < '0' || event.key > '9') event.preventDefault();"
                                        />
        
                                        @error('contact_no')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror

                                    </div>

                                </div>
                            </div>

                            {{-- Registration Information Section --}}
                            <div class="p-4 bg-blue-50 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-blue-800 mb-4">Registration Information</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">


                                    <div>
                                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                            </svg>
                                            CDA Registration No. (RA9520) <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="cda_reg_no"
                                            value="{{ old('cda_reg_no', $externalUser->cda_reg_no ?? '') }}"
                                            maxlength="10"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('cda_registration_no') border-red-500 @enderror"
                                            placeholder="Enter CDA registration number" required>
                                        @error('cda_reg_no')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            Date Registered <span class="text-red-500">*</span>
                                        </label>
                                        @php
                                            $maxCdaDate = now()->toDateString(); // Today's date
                                        @endphp
                                        
                                        <input type="date" name="cda_registration_date"
                                            value="{{ old('cda_registration_date', $generalInfo->cda_registration_date ?? '') }}"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('cda_registration_date') border-red-500 @enderror"
                                            required max="{{ $maxCdaDate }}">
                                        
                                            @error('cda_registration_date')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                </svg>
                                                Common Bond of Membership <span class="text-red-500">*</span>
                                            </label>
                                            <select name="common_bond_membership" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('common_bond_membership') border-red-500 @enderror" required>
                                                <option value="" disabled selected>Select Bond of Membership</option>
                                                <option value="Occupational" {{ old('common_bond_membership', $generalInfo->common_bond_membership ?? '') == 'Occupational' ? 'selected' : '' }}>Occupational</option>
                                                <option value="Associational" {{ old('common_bond_membership', $generalInfo->common_bond_membership ?? '') == 'Associational' ? 'selected' : '' }}>Associational</option>
                                                <option value="Residential" {{ old('common_bond_membership', $generalInfo->common_bond_membership ?? '') == 'Residential' ? 'selected' : '' }}>Residential</option>
                                                <option value="Institutional" {{ old('common_bond_membership', $generalInfo->common_bond_membership ?? '') == 'Institutional' ? 'selected' : '' }}>Institutional</option>
                                            </select>
                                            @error('common_bond_membership')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>                                        

                                    <div>
                                        <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                            Membership Fee per By Laws <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="membership_fee"
                                            value="{{ old('membership_fee', $generalInfo->membership_fee ?? '') }}"
                                            maxlength="5"
                                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('membership_fee') border-red-500 @enderror"
                                            placeholder="Enter membership fee" required>
                                        @error('membership_fee')
                                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- Government Registration Section --}}
                            <div class="p-4 bg-green-50 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-green-800 mb-4">Government Registrations</h3>

                                <div class="grid grid-cols-1 gap-6">
                                    {{-- SSS Information --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                                                </svg>
                                                SSS Employer Registration Number <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="employer_sss_reg_no"
                                                value="{{ old('employer_sss_reg_no', $generalInfo->employer_sss_reg_no ?? '') }}"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('employer_sss_reg_no') border-red-500 @enderror"
                                                placeholder="12-3456789-0" 
                                                pattern="^[0-9]{2}-[0-9]{7}-[0-9]$"
                                                title="Format: 12-3456789-0"
                                                maxlength="12"
                                                required>
                                            <p class="mt-1 text-xs text-gray-500">Format: 12-3456789-0 (include hyphens)</p>
                                            @error('employer_sss_reg_no')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                                </svg>
                                                PAGIBIG Employer Registration Number <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="employer_pagibig_reg_no"
                                                value="{{ old('employer_pagibig_reg_no', $generalInfo->employer_pagibig_reg_no ?? '') }}"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('employer_pagibig_reg_no') border-red-500 @enderror"
                                                placeholder="1234-5678-9012" 
                                                pattern="^[0-9]{4}-[0-9]{4}-[0-9]{4}$"
                                                title="Format: 1234-5678-9012"
                                                maxlength="14"
                                                required>
                                            <p class="mt-1 text-xs text-gray-500">Format: 1234-5678-9012 (include hyphens)</p>
                                            @error('employer_pagibig_reg_no')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                    </div>

                                    {{-- PHILHEALTH Information --}}
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                        <div>
                                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                </svg>
                                                PHILHEALTH Employer Registration Number <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="employer_philhealth_reg_no"
                                                value="{{ old('employer_philhealth_reg_no', $generalInfo->employer_philhealth_reg_no ?? '') }}"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('employer_philhealth_reg_no') border-red-500 @enderror"
                                                placeholder="12-345678901-2" 
                                                pattern="^[0-9]{2}-[0-9]{9}-[0-9]$"
                                                title="Format: 12-345678901-2"
                                                maxlength="14"
                                                required>
                                            <p class="mt-1 text-xs text-gray-500">Format: 12-345678901-2 (include hyphens)</p>
                                            @error('employer_philhealth_reg_no')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                BIR TIN Number <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="bir_tin"
                                                value="{{ old('bir_tin', $generalInfo->bir_tin ?? '') }}"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('bir_tin') border-red-500 @enderror"
                                                placeholder="123-456-789-012" 
                                                pattern="^[0-9]{3}-[0-9]{3}-[0-9]{3}-[0-9]{3}$"
                                                title="Format: 123-456-789-012"
                                                maxlength="15"
                                                required>
                                            <p class="mt-1 text-xs text-gray-500">Format: 123-456-789-012 (include hyphens)</p>
                                            @error('bir_tin')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                                </svg>
                                                BIR Tax Exemption Number <span class="text-red-500">*</span>
                                            </label>
                                            <input type="text" name="bir_tax_exemption_no"
                                                value="{{ old('bir_tax_exemption_no', $generalInfo->bir_tax_exemption_no ?? '') }}"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('bir_tax_exemption_no') border-red-500 @enderror"
                                                placeholder="EXMP-12345-6789" 
                                                pattern="^[A-Z]{4}-[0-9]{5}-[0-9]{4}$"
                                                title="Format: EXMP-12345-6789"
                                                maxlength="15"
                                                required>
                                            <p class="mt-1 text-xs text-gray-500">Format: EXMP-12345-6789 (include hyphens)</p>
                                            @error('bir_tax_exemption_no')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        @php
                                            $minDate = now()->toDateString(); // Today's date
                                            $maxDate = now()->addYears(5)->toDateString(); // 5 years in the future
                                        @endphp
                                    
                                        <div>
                                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                </svg>
                                                BIR Validity <span class="text-red-500">*</span>
                                            </label>
                                            <input type="date" name="bir_validity"
                                                value="{{ old('bir_validity', $generalInfo->bir_validity ?? '') }}"
                                                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 @error('bir_validity') border-red-500 @enderror"
                                                required min="{{ $minDate }}" max="{{ $maxDate }}">
                                            @error('bir_validity')
                                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- WHAT? --}}

                            {{-- Form Actions --}}
                            <div class="flex justify-end space-x-4 mt-8">
                                <a href="{{ route('generalinfo') }}"
                                    class="px-6 py-3 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-200">
                                    Cancel
                                </a>
                                <button type="submit"
                                    class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                                    Save Changes
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- @vite(['resources/js/address.js']) --}}

@endsection