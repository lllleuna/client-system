@extends('layouts.layout')

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

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
                            <h2 class="text-xl font-bold text-gray-800">Finances - Businesses</h2>
                            <div class="flex flex-col sm:flex-row w-full lg:w-auto space-y-3 sm:space-y-0 sm:space-x-3">
                                <a href="{{ route('editbusinesses') }}"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add New Business
                                </a>
                            </div>
                        </div>

                        <!-- Filter and Search Section -->
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                                <div class="w-full sm:w-2/4">
                                    <label for="search"
                                        class="block text-sm font-medium text-gray-700 mb-1">Search</label>
                                    <div class="relative rounded-md shadow-sm">
                                        <input type="text" id="search" name="search"
                                            class="block w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500"
                                            placeholder="Search...">
                                        <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <div class="w-full sm:w-1/4">
                                    <label for="type" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                                        Type</label>
                                    <select id="type" name="type"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">All Types</option>
                                        <option value="existing">Existing</option>
                                        <option value="proposed">Proposed</option>
                                    </select>
                                </div>
                                <div class="w-full sm:w-1/4">
                                    <label for="years" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                                        Years</label>
                                    <select id="years" name="years"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">All Years</option>
                                        <option value="0-1">Less than 1 year</option>
                                        <option value="1-3">1-3 years</option>
                                        <option value="3-5">3-5 years</option>
                                        <option value="5+">5+ years</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Business Table -->
                        <div class="mt-6">
                            <x-success-notif />
                            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-blue-800 mb-4">Business Records</h3>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white rounded-lg overflow-hidden">
                                        <thead class="bg-gray-100 text-gray-700">
                                            <tr>
                                                <th class="py-3 px-4 border text-left">Type</th>
                                                <th class="py-3 px-4 border text-left">Nature of Business</th>
                                                <th class="py-3 px-4 border text-left">Starting Capital</th>
                                                <th class="py-3 px-4 border text-left">Capital to Date</th>
                                                <th class="py-3 px-4 border text-left">Remarks</th>
                                                <th class="py-3 px-4 border text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($businesses as $business)
                                                <tr id="business-{{ $business->id }}">
                                                    <td class="py-3 px-4 border text-left">{{ $business->type }}</td>
                                                    <td class="py-3 px-4 border text-left">
                                                        {{ $business->nature_of_business }}</td>
                                                    <td class="py-3 px-4 border text-left">{{ $business->starting_capital }}
                                                    </td>
                                                    <td class="py-3 px-4 border text-left">{{ $business->capital_to_date }}
                                                    </td>
                                                    <td class="py-3 px-4 border text-left">{{ $business->remarks }}</td>
                                                    <td class="py-3 px-4 border text-center">
                                                        <div class="flex justify-center space-x-2">
                                                            <a href="{{ route('editbusiness', $business->id) }}" class="text-blue-600 hover:text-blue-800">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </a>
                                                            {{-- <a href="javascript:void(0);"
                                                            onclick="confirmDelete({{ $business->id }}, '{{ $business->nature_of_business }}')" class="text-red-600 hover:text-red-800">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </a> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <!-- Pagination Links -->
                                    <div class="my-5 mx-8">
                                        {{ $businesses->links() }}
                                    </div>
                                </div>


                                <!-- Summary Cards -->
                                {{-- <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <h4 class="text-md font-medium text-gray-600 mb-2">Total Businesses</h4>
                                        <p class="text-2xl font-bold text-blue-600">4</p>
                                        <p class="text-sm text-gray-500 mt-1">3 existing, 1 proposed</p>
                                    </div>

                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <h4 class="text-md font-medium text-gray-600 mb-2">Total Initial Capital</h4>
                                        <p class="text-2xl font-bold text-blue-600">₱4,050,000.00</p>
                                        <p class="text-sm text-gray-500 mt-1">All businesses combined</p>
                                    </div>

                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <h4 class="text-md font-medium text-gray-600 mb-2">Current Total Capital</h4>
                                        <p class="text-2xl font-bold text-green-600">₱2,650,000.00</p>
                                        <p class="text-sm text-gray-500 mt-1">Across active businesses</p>
                                    </div>

                                    <div class="bg-white p-4 rounded-lg shadow-sm">
                                        <h4 class="text-md font-medium text-gray-600 mb-2">Active Business Count</h4>
                                        <p class="text-2xl font-bold text-green-600">2</p>
                                        <p class="text-sm text-gray-500 mt-1">50% of total businesses</p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete(id, source) {
            if (confirm(`Are you sure you want to delete ${source}?`)) {
                fetch(`/myinformation/editbusiness/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        alert(data.message);
                        let row = document.getElementById(`business-${id}`);
                        if (row) {
                            row.remove(); // Remove row from the table
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
@endsection
