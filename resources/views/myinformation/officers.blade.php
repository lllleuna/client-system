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
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 space-y-4 lg:space-y-0">
                        <h2 class="text-xl font-bold text-gray-800">Officers and Board of Directors</h2>
                        <div class="flex flex-col sm:flex-row w-full lg:w-auto space-y-3 sm:space-y-0 sm:space-x-3">
                            <a href="{{ route('addOfficerIndex') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg>
                                Add Officer
                            </a>
                        </div>
                    </div>

                    <!-- Search and Filter Section -->
                    <div class="mb-6">
                        <div class="flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-3">
                            <div class="flex-1 relative">
                                <input type="text" 
                                    placeholder="Search by name, role or email..." 
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Officers Table -->
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <x-success-notif />

                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Term in Office</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Information</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($coopOfficers as $coopofficer)
                                <tr class="hover:bg-gray-50" id="officer-{{ $coopofficer->id }}">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $coopofficer->role }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $coopofficer->firstname }} {{ $coopofficer->lastname }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $coopofficer->start_term }} - {{ $coopofficer->end_term }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">{{ $coopofficer->mobile_no }}</div>
                                        <div class="text-sm text-gray-500">{{ $coopofficer->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <div class="flex justify-end space-x-2">
                                            <a href="{{ route('editOfficer', $coopofficer->id) }}" class="text-blue-600 hover:text-blue-900">Edit</a>
                                            <a href="javascript:void(0);" onclick="confirmDelete({{ $coopofficer->id }}, '{{ $coopofficer->firstname }}', '{{ $coopofficer->lastname }}')" class="text-red-600 hover:text-red-900">Remove</a>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Pagination Links -->
                    <div class="my-5 mx-8">
                        {{ $coopOfficers->links() }}
                    </div>
                    
                    <!-- Information Section -->
                    <div class="mt-8 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-blue-600 mt-0.5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <div>
                                <h4 class="text-md font-semibold text-blue-800 mb-2">Officer Information Management</h4>
                                <p class="text-sm text-gray-700 mb-2">Keep officer contact information up-to-date for proper communication and regulatory compliance.</p>
                                <p class="text-sm text-gray-700">A complete roster of officers should be maintained and updated whenever changes in the board composition occur.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        function confirmDelete(id, firstname, lastname) {
        if (confirm(`Are you sure you want to delete ${firstname} ${lastname}?`)) {
            fetch(`/myinformation/officer/${id}`, {
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
                let row = document.getElementById(`officer-${id}`);
                if (row) {
                    row.remove();  // Remove row from the table
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>
@endsection