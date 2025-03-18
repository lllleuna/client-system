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
                            <h2 class="text-xl font-bold text-gray-800">Finances - Loans</h2>
                            <div class="flex flex-col sm:flex-row w-full lg:w-auto space-y-3 sm:space-y-0 sm:space-x-3">
                                <a href="{{ route('editloans') }}"
                                    class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                    </svg>
                                    Add New Loan
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
                                </div>
                            </div>
                        </div>

                        <!-- Filter and Search Section -->
                        <div class="bg-gray-50 p-4 rounded-lg mb-6">
                            <div class="flex flex-col sm:flex-row space-y-3 sm:space-y-0 sm:space-x-3">
                                <div class="w-full sm:w-3/4">
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
                                    <label for="year" class="block text-sm font-medium text-gray-700 mb-1">Filter by
                                        Year</label>
                                    <select id="year" name="year"
                                        class="block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="">All Years</option>
                                        <option value="2025">2025</option>
                                        <option value="2024">2024</option>
                                        <option value="2023">2023</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Loans Table -->
                        <div class="mt-6">
                            <x-success-notif />
                            <div class="bg-blue-50 p-4 rounded-lg mb-6">
                                <h3 class="text-lg font-semibold text-blue-800 mb-4">Loan Records</h3>

                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white rounded-lg overflow-hidden">
                                        <thead class="bg-gray-100 text-gray-700">
                                            <tr>
                                                <th class="py-3 px-4 border text-left">Financing Institution</th>
                                                <th class="py-3 px-4 border text-left">Date Acquired</th>
                                                <th class="py-3 px-4 border text-left">Amount of Loan</th>
                                                <th class="py-3 px-4 border text-left">Utilization</th>
                                                <th class="py-3 px-4 border text-left">Status/Remarks</th>
                                                <th class="py-3 px-4 border text-center">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($Loans as $loan)
                                                <tr id="loan-{{ $loan->id }}">
                                                    <td class="py-3 px-4 border text-left">
                                                        {{ $loan->financing_institution }}</td>
                                                    <td class="py-3 px-4 border text-left">{{ $loan->acquired_at }}</td>
                                                    <td class="py-3 px-4 border text-left">₱{{ $loan->amount }}</td>
                                                    <td class="py-3 px-4 border text-left">{{ $loan->utilization }}</td>
                                                    <td class="py-3 px-4 border text-left">
                                                        <p class="text-sm text-gray-600 mt-1">{{ $loan->remarks }}</p>
                                                    </td>
                                                    <td class="py-3 px-4 border text-center">
                                                        <div class="flex justify-center space-x-2">
                                                            <a href="{{ route('editloan', $loan->id) }}"
                                                                class="text-blue-600 hover:text-blue-800">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                                </svg>
                                                            </a>
                                                            <a href="javascript:void(0);"
                                                                onclick="confirmDelete({{ $loan->id }}, '{{ $loan->financing_institution }}')"
                                                                class="text-red-600 hover:text-red-800">
                                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                                    viewBox="0 0 24 24">
                                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                                        stroke-width="2"
                                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                </svg>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <!-- Pagination Links -->
                                    <div class="my-5 mx-8">
                                        {{ $Loans->links() }}
                                    </div>
                                </div>



                                <!-- Summary Cards -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                                    @foreach ($loansPerYear as $loanYear)
                                        <div class="bg-white p-4 rounded-lg shadow-sm mb-4">
                                            <h4 class="text-md font-medium text-gray-600 mb-2">Loans for year
                                                {{ $loanYear->year }}</h4>
                                            <p class="text-2xl font-bold text-green-600">
                                                ₱{{ number_format($loanYear->total_amount, 2) }}</p>
                                            <p class="text-sm text-gray-500 mt-1">{{ $loanYear->total_loans }}
                                                loan/s</p>
                                        </div>
                                    @endforeach

                                </div>
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
                fetch(`/myinformation/editloans/${id}`, {
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
                        let row = document.getElementById(`loan-${id}`);
                        if (row) {
                            row.remove(); // Remove row from the table
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        }
    </script>
@endsection
