@extends('layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    <div class="min-h-screen p-6 lg:p-8">
        {{-- Header Section --}}
        <div class="max-w-4xl mx-auto mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Training History</h1>
            <p class="text-gray-600">
                Access your cooperative's training records and certificates. View detailed information about past training sessions and download certificates.
            </p>
        </div>

        {{-- Main Content --}}
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            {{-- Search and Filter Section --}}
            <div class="p-6 border-b">
                <div class="flex flex-col md:flex-row gap-4">
                    {{-- BACKEND TODO: Add form handling for search and filters --}}
                    <div class="flex-1">
                        <input 
                            type="text" 
                            placeholder="Search training records..." 
                            class="w-full px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        >
                    </div>
                    <div class="flex gap-4">
                        <select class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Filter by Year</option>
                            <option value="2024">2024</option>
                            <option value="2023">2023</option>
                            <option value="2022">2022</option>
                        </select>
                        <select class="px-4 py-2 border rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Filter by Type</option>
                            <option value="seminar">Seminar</option>
                            <option value="workshop">Workshop</option>
                            <option value="conference">Conference</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- Training Records Table --}}
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Training Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Venue</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participant Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        {{-- BACKEND TODO: Replace with actual training records loop --}}
                        @php
                            $sampleRecords = [
                                [
                                    'name' => 'Cooperative Management Training',
                                    'date' => 'March 15, 2024',
                                    'venue' => 'OTC Training Center, Manila',
                                    'participant' => [
                                        'first_name' => 'Juan',
                                        'middle_name' => 'Dela',
                                        'last_name' => 'Cruz'
                                    ],
                                    'status' => 'Completed'
                                ],
                                [
                                    'name' => 'Financial Management Workshop',
                                    'date' => 'February 20, 2024',
                                    'venue' => 'Virtual Meeting',
                                    'participant' => [
                                        'first_name' => 'Maria',
                                        'middle_name' => 'Santos',
                                        'last_name' => 'Garcia'
                                    ],
                                    'status' => 'In Progress'
                                ]
                            ];
                        @endphp

                        @foreach($sampleRecords as $record)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $record['name'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $record['date'] }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900">{{ $record['venue'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $record['participant']['first_name'] }}
                                        {{ $record['participant']['middle_name'] }}
                                        {{ $record['participant']['last_name'] }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-medium {{ $record['status'] === 'Completed' ? 'text-green-700 bg-green-100' : 'text-yellow-700 bg-yellow-100' }} rounded-full">
                                        {{ $record['status'] }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex justify-end space-x-3">
                                        {{-- BACKEND TODO: Replace with actual route for certificate download --}}
                                        <a href="#" class="text-blue-600 hover:text-blue-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                            </svg>
                                        </a>
                                        <a href="#" class="text-gray-600 hover:text-gray-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            <div class="px-6 py-4 border-t">
                {{-- BACKEND TODO: Replace with actual pagination component --}}
                <div class="flex justify-between items-center">
                    <div class="text-sm text-gray-700">
                        Showing 1 to 2 of 2 entries
                    </div>
                    <div class="flex space-x-2">
                        <button class="px-3 py-1 border rounded-md text-sm disabled:opacity-50">Previous</button>
                        <button class="px-3 py-1 border rounded-md text-sm bg-blue-50 text-blue-600">1</button>
                        <button class="px-3 py-1 border rounded-md text-sm disabled:opacity-50">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection