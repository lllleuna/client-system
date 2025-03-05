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
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 space-y-4 lg:space-y-0">
                        <h2 class="text-xl font-bold text-gray-800">Certificate of Good Standing (CGS)</h2>
                        <div class="flex flex-col sm:flex-row w-full lg:w-auto space-y-3 sm:space-y-0 sm:space-x-3">
                            <a href="{{ route('editcgs') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                            <div class="flex w-full sm:w-auto space-x-2">
                                <button class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    Export PDF
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Current CGS Information -->
                    <div class="bg-green-50 p-6 rounded-lg mb-6 border border-green-200">
                        <div class="flex items-center mb-4">
                            <svg class="w-8 h-8 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <h3 class="text-lg font-semibold text-green-800">Current Certificate Status</h3>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">CGS No.</p>
                                <p class="text-xl font-bold text-gray-800">{{ $cgs->current_cgs_number ?? '2021-082' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Current Status</p>
                                <div class="flex items-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ strtotime($cgs->current_expiration_date ?? '2024-06-30') > time() ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ strtotime($cgs->current_expiration_date ?? '2024-06-30') > time() ? 'Active' : 'Expired' }}
                                    </span>
                                </div>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">CGS Issuance Date</p>
                                <p class="text-md font-medium text-gray-800">{{ $cgs->current_issuance_date ?? 'January 11, 2024' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">CGS Expiration Date</p>
                                <p class="text-md font-medium text-gray-800">{{ $cgs->current_expiration_date ?? 'June 30, 2024' }}</p>
                            </div>
                            <div class="md:col-span-2">
                                <div class="h-3 relative max-w-xl rounded-full overflow-hidden bg-gray-200">
                                    @php
                                        $expirationDate = strtotime($cgs->current_expiration_date ?? '2024-06-30');
                                        $issueDate = strtotime($cgs->current_issuance_date ?? '2024-01-11');
                                        $currentDate = time();
                                        $totalDays = $expirationDate - $issueDate;
                                        $daysElapsed = $currentDate - $issueDate;
                                        $percent = min(100, max(0, ($daysElapsed / $totalDays) * 100));
                                    @endphp
                                    <div class="h-full bg-blue-600 rounded-full" style="width: {{ $percent }}%"></div>
                                </div>
                                <div class="flex justify-between text-xs text-gray-600 mt-1">
                                    <span>Issue Date</span>
                                    <span>Validity Period</span>
                                    <span>Expiration</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Historical CGS Records -->
                    <div class="mt-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">CGS History Records</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white rounded-lg overflow-hidden border border-gray-200">
                                <thead class="bg-gray-100 text-gray-700">
                                    <tr>
                                        <th class="py-3 px-4 border-b text-left">Entry Year</th>
                                        <th class="py-3 px-4 border-b text-left">CGS No.</th>
                                        <th class="py-3 px-4 border-b text-left">Date of Issuance</th>
                                        <th class="py-3 px-4 border-b text-left">Expiration Date</th>
                                        <th class="py-3 px-4 border-b text-left">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 border-b">2024</td>
                                        <td class="py-3 px-4 border-b">{{ $cgs->accreditation_number_2024 ?? '2021-082' }}</td>
                                        <td class="py-3 px-4 border-b">{{ $cgs->issuance_date_2024 ?? 'January 11, 2024' }}</td>
                                        <td class="py-3 px-4 border-b">{{ $cgs->expiration_date_2024 ?? 'June 30, 2024' }}</td>
                                        <td class="py-3 px-4 border-b">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 border-b">2022-2023</td>
                                        <td class="py-3 px-4 border-b">{{ $cgs->accreditation_number_2023 ?? '2021-082' }}</td>
                                        <td class="py-3 px-4 border-b">{{ $cgs->issuance_date_2023 ?? 'March 27, 2023' }}</td>
                                        <td class="py-3 px-4 border-b">{{ $cgs->expiration_date_2023 ?? 'June 30, 2023' }}</td>
                                        <td class="py-3 px-4 border-b">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Expired
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="hover:bg-gray-50">
                                        <td class="py-3 px-4 border-b">2021-2022</td>
                                        <td class="py-3 px-4 border-b">{{ $cgs->accreditation_number_2021 ?? '2021-082' }}</td>
                                        <td class="py-3 px-4 border-b">{{ $cgs->issuance_date_2021 ?? 'May 8, 2021' }}</td>
                                        <td class="py-3 px-4 border-b">{{ $cgs->expiration_date_2021 ?? 'June 30, 2022' }}</td>
                                        <td class="py-3 px-4 border-b">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Expired
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Notes and Instructions Section -->
                    <div class="mt-8 p-4 bg-yellow-50 rounded-lg border border-yellow-200">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-yellow-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-md font-semibold text-yellow-800 mb-2">Important Information</h4>
                                <p class="text-sm text-gray-700 mb-2">The Certificate of Good Standing (CGS) is valid for one year and must be renewed annually to maintain compliance.</p>
                                <p class="text-sm text-gray-700">Please ensure to initiate the renewal process at least 30 days before the expiration date to avoid any operational disruptions.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection