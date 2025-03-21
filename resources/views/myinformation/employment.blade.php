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
                        <h2 class="text-xl font-bold text-gray-800">Operations</h2>
                        <div class="flex flex-col sm:flex-row w-full lg:w-auto space-y-3 sm:space-y-0 sm:space-x-3">
                            <div class="flex w-full sm:w-auto space-x-2">
                                <button class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                    </svg>
                                    Export CSV
                                </button>
                                <button class="flex-1 sm:flex-none inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Import CSV
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Employment Information -->
                    <div class="mt-6">
                        <div class="bg-blue-50 p-4 rounded-lg mb-6">
                            <h3 class="text-lg font-semibold text-blue-800 mb-2">STATUS OF EMPLOYMENT</h3>
                            <p class="text-sm text-gray-600 mb-4">(Indicate only those employees with salary / wage)</p>
                            
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white rounded-lg overflow-hidden">
                                    <thead class="bg-gray-100 text-gray-700">
                                        <tr>
                                            <th rowspan="2" class="py-3 px-4 border text-left">Type of Employee</th>
                                            <th colspan="2" class="py-3 px-4 border text-center">Probationary</th>
                                            <th colspan="2" class="py-3 px-4 border text-center">Regular</th>
                                            <th rowspan="2" class="py-3 px-4 border text-center">TOTAL</th>
                                        </tr>
                                        <tr>
                                            <th class="py-2 px-4 border text-center">M</th>
                                            <th class="py-2 px-4 border text-center">F</th>
                                            <th class="py-2 px-4 border text-center">M</th>
                                            <th class="py-2 px-4 border text-center">F</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="py-3 px-4 border text-left">Drivers</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->driver_probationary_male ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->driver_probationary_female ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->driver_regular_male ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->driver_regular_female ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">
                                                {{ ($coopEmployment->driver_probationary_male ?? 0) + 
                                                   ($coopEmployment->driver_probationary_female ?? 0) + 
                                                   ($coopEmployment->driver_regular_male ?? 0) + 
                                                   ($coopEmployment->driver_regular_female ?? 0) }}
                                            </td>
                                        </tr>
                                        <tr class="bg-gray-50">
                                            <td class="py-3 px-4 border text-left">Management Staff</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->operator_probationary_male ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->operator_probationary_female ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->operator_regular_male ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->operator_regular_female ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">
                                                {{ ($coopEmployment->operator_probationary_male ?? 0) + 
                                                   ($coopEmployment->operator_probationary_female ?? 0) + 
                                                   ($coopEmployment->operator_regular_male ?? 0) + 
                                                   ($coopEmployment->operator_regular_female ?? 0) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="py-3 px-4 border text-left">Allied Workers</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->allied_probationary_male ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->allied_probationary_female ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->allied_regular_male ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">{{ $coopEmployment->allied_regular_female ?? '0' }}</td>
                                            <td class="py-3 px-4 border text-center">
                                                {{ ($coopEmployment->allied_probationary_male ?? 0) + 
                                                   ($coopEmployment->allied_probationary_female ?? 0) + 
                                                   ($coopEmployment->allied_regular_male ?? 0) + 
                                                   ($coopEmployment->allied_regular_female ?? 0) }}
                                            </td>
                                        </tr>
                                        <tr class="bg-blue-50 font-bold">
                                            <td class="py-3 px-4 border text-left">TOTAL</td>
                                            <td class="py-3 px-4 border text-center">
                                                {{ ($coopEmployment->driver_probationary_male ?? 0) + 
                                                   ($coopEmployment->operator_probationary_male ?? 0) + 
                                                   ($coopEmployment->allied_probationary_male ?? 0) }}
                                            </td>
                                            <td class="py-3 px-4 border text-center">
                                                {{ ($coopEmployment->driver_probationary_female ?? 0) + 
                                                   ($coopEmployment->operator_probationary_female ?? 0) + 
                                                   ($coopEmployment->allied_probationary_female ?? 0) }}
                                            </td>
                                            <td class="py-3 px-4 border text-center">
                                                {{ ($coopEmployment->driver_regular_male ?? 0) + 
                                                   ($coopEmployment->operator_regular_male ?? 0) + 
                                                   ($coopEmployment->allied_regular_male ?? 0) }}
                                            </td>
                                            <td class="py-3 px-4 border text-center">
                                                {{ ($coopEmployment->driver_regular_female ?? 0) + 
                                                   ($coopEmployment->operator_regular_female ?? 0) + 
                                                   ($coopEmployment->allied_regular_female ?? 0) }}
                                            </td>
                                            <td class="py-3 px-4 border text-center">
                                                {{ ($coopEmployment->driver_probationary_male ?? 0) + 
                                                   ($coopEmployment->driver_probationary_female ?? 0) + 
                                                   ($coopEmployment->driver_regular_male ?? 0) + 
                                                   ($coopEmployment->driver_regular_female ?? 0) +
                                                   ($coopEmployment->operator_probationary_male ?? 0) + 
                                                   ($coopEmployment->operator_probationary_female ?? 0) + 
                                                   ($coopEmployment->operator_regular_male ?? 0) + 
                                                   ($coopEmployment->operator_regular_female ?? 0) +
                                                   ($coopEmployment->allied_probationary_male ?? 0) + 
                                                   ($coopEmployment->allied_probationary_female ?? 0) + 
                                                   ($coopEmployment->allied_regular_male ?? 0) + 
                                                   ($coopEmployment->allied_regular_female ?? 0) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Summary Cards -->
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="text-md font-medium text-gray-600 mb-2">Probationary Employees</h4>
                                    <p class="text-2xl font-bold text-blue-600">
                                        {{ ($coopEmployment->driver_probationary_male ?? 0) + 
                                           ($coopEmployment->driver_probationary_female ?? 0) +
                                           ($coopEmployment->operator_probationary_male ?? 0) + 
                                           ($coopEmployment->operator_probationary_female ?? 0) +
                                           ($coopEmployment->allied_probationary_male ?? 0) + 
                                           ($coopEmployment->allied_probationary_female ?? 0) }}
                                    </p>
                                    <div class="flex justify-between text-sm mt-2">
                                        <span class="text-blue-800">Males: 
                                            {{ ($coopEmployment->driver_probationary_male ?? 0) + 
                                               ($coopEmployment->operator_probationary_male ?? 0) + 
                                               ($coopEmployment->allied_probationary_male ?? 0) }}
                                        </span>
                                        <span class="text-pink-600">Females: 
                                            {{ ($coopEmployment->driver_probationary_female ?? 0) + 
                                               ($coopEmployment->operator_probationary_female ?? 0) + 
                                               ($coopEmployment->allied_probationary_female ?? 0) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="text-md font-medium text-gray-600 mb-2">Regular Employees</h4>
                                    <p class="text-2xl font-bold text-blue-600">
                                        {{ ($coopEmployment->driver_regular_male ?? 0) + 
                                           ($coopEmployment->driver_regular_female ?? 0) +
                                           ($coopEmployment->operator_regular_male ?? 0) + 
                                           ($coopEmployment->operator_regular_female ?? 0) +
                                           ($coopEmployment->allied_regular_male ?? 0) + 
                                           ($coopEmployment->allied_regular_female ?? 0) }}
                                    </p>
                                    <div class="flex justify-between text-sm mt-2">
                                        <span class="text-blue-800">Males: 
                                            {{ ($coopEmployment->driver_regular_male ?? 0) + 
                                               ($coopEmployment->operator_regular_male ?? 0) + 
                                               ($coopEmployment->allied_regular_male ?? 0) }}
                                        </span>
                                        <span class="text-pink-600">Females: 
                                            {{ ($coopEmployment->driver_regular_female ?? 0) + 
                                               ($coopEmployment->operator_regular_female ?? 0) + 
                                               ($coopEmployment->allied_regular_female ?? 0) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="bg-white p-4 rounded-lg shadow-sm">
                                    <h4 class="text-md font-medium text-gray-600 mb-2">Total Employees</h4>
                                    <p class="text-2xl font-bold text-blue-600">
                                        {{ ($coopEmployment->driver_probationary_male ?? 0) + 
                                           ($coopEmployment->driver_probationary_female ?? 0) + 
                                           ($coopEmployment->driver_regular_male ?? 0) + 
                                           ($coopEmployment->driver_regular_female ?? 0) +
                                           ($coopEmployment->operator_probationary_male ?? 0) + 
                                           ($coopEmployment->operator_probationary_female ?? 0) + 
                                           ($coopEmployment->operator_regular_male ?? 0) + 
                                           ($coopEmployment->operator_regular_female ?? 0) +
                                           ($coopEmployment->allied_probationary_male ?? 0) + 
                                           ($coopEmployment->allied_probationary_female ?? 0) + 
                                           ($coopEmployment->allied_regular_male ?? 0) + 
                                           ($coopEmployment->allied_regular_female ?? 0) }}
                                    </p>
                                    <div class="flex justify-between text-sm mt-2">
                                        <span class="text-blue-800">Males: 
                                            {{ ($coopEmployment->driver_probationary_male ?? 0) + 
                                               ($coopEmployment->driver_regular_male ?? 0) +
                                               ($coopEmployment->operator_probationary_male ?? 0) + 
                                               ($coopEmployment->operator_regular_male ?? 0) +
                                               ($coopEmployment->allied_probationary_male ?? 0) + 
                                               ($coopEmployment->allied_regular_male ?? 0) }}
                                        </span>
                                        <span class="text-pink-600">Females: 
                                            {{ ($coopEmployment->driver_probationary_female ?? 0) + 
                                               ($coopEmployment->driver_regular_female ?? 0) +
                                               ($coopEmployment->operator_probationary_female ?? 0) + 
                                               ($coopEmployment->operator_regular_female ?? 0) +
                                               ($coopEmployment->allied_probationary_female ?? 0) + 
                                               ($coopEmployment->allied_regular_female ?? 0) }}
                                        </span>
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