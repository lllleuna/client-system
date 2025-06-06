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
                        <h2 class="text-xl font-bold text-gray-800">Operations - Units</h2>
                        <div class="flex flex-col sm:flex-row w-full lg:w-auto space-y-3 sm:space-y-0 sm:space-x-3">
                            <a href="{{ route('editunits') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Edit
                            </a>
                        </div>
                    </div>

                    <!-- Units Information -->
                    <div class="mt-6">
                        <div class="bg-blue-50 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-semibold text-blue-800 mb-2">Mode/Type of Unit</h3>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th rowspan="2" class="py-3 px-4 border text-left">Mode/Type of Unit</th>
                                            <th class="py-3 px-4 border text-center">2021</th>
                                            <th class="py-3 px-4 border text-center">2022</th>
                                            <th class="py-3 px-4 border text-center">2023</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-3 px-4 border text-left">No. of Cooperatively Owned Units</td>
                                            <td class="py-3 px-4 border text-center">{{ $units->coop_owned_2021 ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $units->coop_owned_2022 ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $units->coop_owned_2023 ?? '0' }}</td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="py-3 px-4 border text-left">No. of Individually Owned Units</td>
                                            <td class="py-3 px-4 border text-center">{{ $units->individual_owned_2021 ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $units->individual_owned_2022 ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $units->individual_owned_2023 ?? '0' }}</td>
                                        </tr>
                                        <tr class="bg-blue-50 font-bold">
                                            <td class="py-3 px-4 border text-left">TOTAL</td>
                                            <td class="py-3 px-4 border text-center">{{ ($units->coop_owned_2021 ?? 0) + ($units->individual_owned_2021 ?? 0) }}</td>
                                            <td class="py-3 px-4 border text-center">{{ ($units->coop_owned_2022 ?? 0) + ($units->individual_owned_2022 ?? 0) }}</td>
                                            <td class="py-3 px-4 border text-center">{{ ($units->coop_owned_2023 ?? 0) + ($units->individual_owned_2023 ?? 0) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Summary Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="text-md font-medium text-gray-600 mb-2">2021 Total Units</h4>
                                    <p class="text-2xl font-bold text-blue-600">{{ ($units->coop_owned_2021 ?? 0) + ($units->individual_owned_2021 ?? 0) }}</p>
                                    <div class="flex justify-between text-sm mt-2">
                                        <span class="text-blue-800">Cooperative: {{ $units->coop_owned_2021 ?? '0' }}</span>
                                        <span class="text-green-600">Individual: {{ $units->individual_owned_2021 ?? '0' }}</span>
                                    </div>
                                </div>
                                
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="text-md font-medium text-gray-600 mb-2">2022 Total Units</h4>
                                    <p class="text-2xl font-bold text-blue-600">{{ ($units->coop_owned_2022 ?? 0) + ($units->individual_owned_2022 ?? 0) }}</p>
                                    <div class="flex justify-between text-sm mt-2">
                                        <span class="text-blue-800">Cooperative: {{ $units->coop_owned_2022 ?? '0' }}</span>
                                        <span class="text-green-600">Individual: {{ $units->individual_owned_2022 ?? '0' }}</span>
                                    </div>
                                </div>
                                
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="text-md font-medium text-gray-600 mb-2">2023 Total Units</h4>
                                    <p class="text-2xl font-bold text-blue-600">{{ ($units->coop_owned_2023 ?? 0) + ($units->individual_owned_2023 ?? 0) }}</p>
                                    <div class="flex justify-between text-sm mt-2">
                                        <span class="text-blue-800">Cooperative: {{ $units->coop_owned_2023 ?? '0' }}</span>
                                        <span class="text-green-600">Individual: {{ $units->individual_owned_2023 ?? '0' }}</span>
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