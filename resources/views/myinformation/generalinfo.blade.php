@extends('layouts.layout')
@section('content')
    <div class="min-h-screen bg-gray-50 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
                {{-- Sidebar --}}
                @include('components.sidebar')
                <!-- Main Content -->
                <div class="lg:col-span-9">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4 lg:p-6">
                        <!-- Header Section -->
                        <div
                            class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 space-y-4 lg:space-y-0">
                            <h2 class="text-xl font-bold text-gray-800">Operations</h2>
                            <div class="flex flex-col sm:flex-row w-full lg:w-auto space-y-3 sm:space-y-0 sm:space-x-3">
                                <a href="{{ route('editgeneralinfo') }}"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <div class="flex w-full sm:w-auto space-x-2">
                                    <button
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                        </svg>
                                        Export CSV
                                    </button>
                                    <button
                                        class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Import CSV
                                    </button>
                                </div>
                            </div>
                        </div>

                        <x-success-notif />

                        <!-- General Information Form -->
                        <div class="mt-6">
                            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-blue-800 mb-2">General Information</h3>

                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Basic Information -->
                                    <div class="space-y-4">
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">NAME OF TC (IN FULL)</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $externalUser->tc_name ?? 'Not Available' }}</p>
                                        </div>


                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">BUSINESS ADDRESS</p>
                                            <p class="text-md font-semibold text-gray-800">{{ $fullAddress }}</p>
                                        </div>

                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">OFFICIAL EMAIL ADDRESS</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $externalUser->email ?? 'Not Available' }}</p>
                                        </div>

                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">OFFICIAL CONTACT NO.</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $externalUser->contact_no ?? 'Not Available' }}</p>
                                        </div>


                                    </div>

                                    <!-- Registration Information -->
                                    <div class="space-y-4">
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                                <p class="text-sm text-gray-500 font-medium mb-1">ACCREDITATION NO. (RA9520)
                                                </p>

                                                @if ($mainrecord->accreditation_no)
                                                    <p class="text-md font-semibold text-green-600">
                                                        {{ $mainrecord->accreditation_no }}
                                                    </p>
                                                @else
                                                    <p class="text-md font-semibold text-red-600">
                                                        Not Available
                                                    </p>
                                                @endif
                                            </div>


                                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                                <p class="text-sm text-gray-500 font-medium mb-1">DATE ACCREDITED</p>

                                                @if ($mainrecord && $mainrecord->accreditation_date)
                                                    <p class="text-md font-semibold text-green-600">
                                                        {{ \Carbon\Carbon::parse($mainrecord->accreditation_date)->format('M j, Y') }}
                                                    </p>
                                                @else
                                                    <p class="text-md font-semibold text-red-600">
                                                        Not Available
                                                    </p>
                                                @endif
                                            </div>


                                        </div>

                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                                <p class="text-sm text-gray-500 font-medium mb-1">CDA REGISTRATION NO.
                                                    (RA9520)</p>
                                                <p class="text-md font-semibold text-gray-800">
                                                    {{ $externalUser->cda_reg_no ?? 'Not Available' }}</p>
                                            </div>

                                            <div class="bg-white p-4 rounded-lg shadow-sm">
                                                <p class="text-sm text-gray-500 font-medium mb-1">DATE REGISTERED</p>
                                                <p class="text-md font-semibold text-gray-800">
                                                    {{ $generalInfo->cda_registration_date ?? 'Not Available' }}</p>
                                            </div>
                                        </div>

                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">COMMON BOND OF MEMBERSHIP</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->common_bond_membership ?? 'Not Available' }}</p>
                                        </div>

                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">MEMBERSHIP FEE PER BY LAWS</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->membership_fee ?? 'Not Available' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Government Registration Information -->
                            <div class="bg-green-50 p-4 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-green-800 mb-2">Government Registrations</h3>

                                <div class="grid grid-cols-1 gap-6">
                                    <!-- SSS Information -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">SSS EMPLOYER REGISTRATION
                                                NUMBER</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->employer_sss_reg_no ?? 'Not Available' }}</p>
                                        </div>

                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">NO. OF SSS ENROLLED EMPLOYEES
                                            </p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->total_sss_enrolled ?? 'Not Available' }}</p>
                                        </div>
                                    </div>

                                    <!-- PAGIBIG Information -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">PAGIBIG EMPLOYER REGISTRATION
                                                NUMBER</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->employer_pagibig_reg_no ?? 'Not Available' }}</p>
                                        </div>

                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">NO. OF PAGIBIG ENROLLED
                                                EMPLOYEES</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->total_pagibig_enrolled ?? 'Not Available' }}</p>
                                        </div>
                                    </div>

                                    <!-- PHILHEALTH Information -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">PHILHEALTH EMPLOYER
                                                REGISTRATION NUMBER</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->employer_philhealth_reg_no ?? 'Not Available' }}</p>
                                        </div>

                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">NO. OF PHILHEALTH ENROLLED
                                                EMPLOYEES</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->total_philhealth_enrolled ?? 'Not Available' }}</p>
                                        </div>
                                    </div>

                                    <!-- BIR Information -->
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">BIR TIN NUMBER</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->bir_tin ?? 'Not Available' }}</p>
                                        </div>

                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">BIR TAX EXEMPTION NUMBER</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->bir_tax_exemption_no ?? 'Not Available' }}</p>
                                        </div>

                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <p class="text-sm text-gray-500 font-medium mb-1">VALIDITY</p>
                                            <p class="text-md font-semibold text-gray-800">
                                                {{ $generalInfo->bir_validity ?? 'Not Available' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
