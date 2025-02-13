@extends('layouts.layout')

@section('content')
<!-- Main Content Area -->
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-12 gap-6">
            @include('components.sidebar')

            <!-- Main Content -->
            <div class="col-span-9">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <!-- Header Section -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-800">Individually-Owned Units</h2>
                        
                        <div class="flex space-x-3">
                            <a href="{{ route('editindividuallyowned') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Add New Unit
                            </a>
                            <button class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Export CSV</button>
                            <button onclick="openImportModal()" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Import CSV</button>
                        </div>
                    </div>

                    <!-- Search and Filter Section -->
                    <div class="mb-6">
                        <div class="grid grid-cols-3 gap-4">
                            <div class="col-span-2">
                                <input type="text" 
                                       placeholder="Search by Name, Plate No, or MV File No..." 
                                       class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400">
                            </div>
                            <div>
                                <select class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400">
                                    <option value="">Filter by Type</option>
                                    <option value="bus">Bus</option>
                                    <option value="van">Van</option>
                                    <option value="jeep">Jeep</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- Table Section -->
                    <div class="relative">
                        <div class="overflow-x-auto border rounded-lg">
                            <table class="w-full whitespace-nowrap">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-32">Type</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase w-32">Plate No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">MV File No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Engine No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Chassis No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">LTFRB Case No</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date Granted</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date of Expiry</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">First Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Middle Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Last Name</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Origin</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Via</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Destination</th>
                                        <th class="sticky right-0 z-10 bg-white px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Sample Row 1 -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 w-32">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Bus</span>
                                        </td>
                                        <td class="px-6 py-4 w-32">ABC 123</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">MV-001</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">ENG-001</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">CHS-001</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">LTFRB-001</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">2024-01-01</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">2029-01-01</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">John Michael</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Velasco</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Atutubs</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Manila</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">EDSA</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Quezon City</td>
                                        <td class="sticky right-0 z-10 bg-white px-6 py-4 text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <x-edit-button href="#" />
                                                <x-delete-button action="#" />
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Sample Row 2 -->
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 w-32">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Van</span>
                                        </td>
                                        <td class="px-6 py-4 w-32">XYZ 789</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">MV-002</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">ENG-002</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">CHS-002</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">LTFRB-002</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">2024-02-01</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">2029-02-01</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">John Michael</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Velasco</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Atutubs</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Makati</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">C5</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">Taguig</td>
                                        <td class="sticky right-0 z-10 bg-white px-6 py-4 text-right text-sm font-medium">
                                            <div class="flex justify-end space-x-2">
                                                <x-edit-button href="#" />
                                                <x-delete-button action="#" />
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-6 flex justify-between items-center">
                        <div class="text-sm text-gray-700">
                            Showing <span class="font-medium">1</span> to <span class="font-medium">2</span> of <span class="font-medium">20</span> results
                        </div>
                        <div class="flex space-x-2">
                            <button class="px-3 py-1 border rounded-md disabled:opacity-50">Previous</button>
                            <button class="px-3 py-1 border rounded-md bg-blue-600 text-white">1</button>
                            <button class="px-3 py-1 border rounded-md">2</button>
                            <button class="px-3 py-1 border rounded-md">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Import Modal -->
<div id="importModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3 text-center">
            <h3 class="text-lg leading-6 font-medium text-gray-900">Import Individual Unit Records</h3>
            <form class="mt-4">
                <div class="mt-2">
                    <input type="file" accept=".csv" class="w-full px-4 py-2 border rounded-lg">
                </div>
                <div class="mt-4">
                    <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">Import</button>
                    <button type="button" onclick="closeImportModal()" class="ml-2 px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Simple JavaScript for Modal -->
<script>
    function openImportModal() {
        document.getElementById('importModal').classList.remove('hidden');
    }

    function closeImportModal() {
        document.getElementById('importModal').classList.add('hidden');
    }
</script>
@endsection