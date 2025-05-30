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
                        <h2 class="text-xl font-bold text-gray-800">Individually Owned Units</h2>
                        <div class="flex flex-col sm:flex-row w-full lg:w-auto space-y-3 sm:space-y-0 sm:space-x-3">
                            <a href="{{ route('addIndivUnitIndex') }}" class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add Unit
                            </a>
                        </div>
                    </div>

                    <!-- Search and Filter Section -->
                    <div class="mb-6">
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <div class="sm:col-span-2">
                                <div class="relative">
                                    <input type="text" 
                                           placeholder="Search by Plate No, MV File No, or Type..." 
                                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 pl-10">
                                    <svg class="w-5 h-5 absolute left-3 top-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200">
                                    <option value="">Filter by Type</option>
                                    <option value="bus">Bus</option>
                                    <option value="van">Van</option>
                                    <option value="jeep">Jeep</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="overflow-x-auto -mx-4 sm:-mx-6 lg:-mx-8">
                        <x-success-notif />
                        <div class="inline-block min-w-full py-2 align-middle px-4 sm:px-6 lg:px-8">
                            <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50 w-full">
                                        <tr>
                                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Type</th>
                                            <th class="px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Plate No.</th>
                                            <th class="hidden sm:table-cell px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">LTFRB Case No.</th>
                                            <th class="hidden md:table-cell px-3 sm:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date Valid</th>
                                            <th class="px-3 sm:px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr class="sm:hidden">
                                            <!-- Mobile-only info -->
                                            <div class="sm:hidden mt-1 text-xs text-gray-500">
                                                MV File: MV-001 <br>
                                                Engine: ENG-001 <br>
                                                Chassis: CHS-001
                                            </div>
                                        </tr>
                                        @foreach ($indivUnits as $indivunit)
                                        <tr class="hover:bg-gray-50" id="unit-{{ $indivunit->id }}">
                                            <td class="px-3 sm:px-6 py-4">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $indivunit->type}}</span>
                                            </td>
                                            <td class="hidden sm:table-cell px-3 sm:px-6 py-4 text-sm text-gray-500">{{ $indivunit->plate_no }}</td>
                                            <td class="hidden md:table-cell px-3 sm:px-6 py-4 text-sm text-gray-500">{{ $indivunit->ltfrb_case_no }}</td>
                                            <td class="hidden lg:table-cell px-3 sm:px-6 py-4 text-sm text-gray-500">{{ $indivunit->date_of_expiry }}</td>
                                            <td class="py-3 px-4 border text-center">
                                                <div class="flex justify-center space-x-2">
                                                    <a href="{{ route('editIndivUnit', $indivunit->id) }}" class="text-blue-600 hover:text-blue-800">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                        </svg>
                                                    </a>
                                                    <a href="javascript:void(0);" onclick="confirmDelete({{ $indivunit->id }}, '{{ $indivunit->plate_no }}')" class="text-red-600 hover:text-red-800">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <!-- Additional rows... -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Pagination Links -->
                    <div class="my-5 mx-8">
                        {{ $indivUnits->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import CSV Modal -->
<div id="importModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50">
    <div class="relative top-20 mx-auto p-5 border w-full max-w-md shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Import Unit Records</h3>
            <form action="#" method="POST" enctype="multipart/form-data" class="mt-4">
                @csrf
                <div class="mt-2">
                    <input type="file" name="file" accept=".csv" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div class="mt-4 flex justify-center space-x-3">
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Import
                    </button>
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    const searchInput = document.querySelector('input[type="text"]');
    searchInput.addEventListener('input', function(e) {
        // Implement search logic here
    });

    function openModal() {
        document.getElementById('importModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('importModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('importModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });


    function confirmDelete(id, plate_no) {
        if (confirm(`Are you sure you want to delete ${plate_no} ?`)) {
            fetch(`/myinformation/indivownedunit/${id}`, {
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
                let row = document.getElementById(`unit-${id}`);
                if (row) {
                    row.remove();  // Remove row from the table
                }
            })
            .catch(error => console.error('Error:', error));
        }
    }
</script>

@push('scripts')

@endpush
@endsection