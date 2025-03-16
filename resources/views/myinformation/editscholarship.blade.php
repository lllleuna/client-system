@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-12 gap-6">
            {{-- Sidebar  --}}
            @include('components.sidebar')
            {{-- Main Content --}}
            <div class="col-span-9">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold text-gray-800">Scholarship Programs</h2>
                        <a href="#" class="text-gray-500 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>

                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <!-- Scholarship Programs Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg table-fixed" id="scholarship-table">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Scholarship Program  <span class="text-red-500">*</span>
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Course Taken <span class="text-red-500">*</span>
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            No. of TC Scholar Beneficiary <span class="text-red-500">*</span>
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Action 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200" id="scholarship-body">
                                    <!-- Scholarship rows will be added here dynamically -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4" class="px-6 py-4">
                                            <button type="button" id="add-scholarship-btn" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Add Scholarship Program
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                            <a href="{{ route('scholarships') }}"
                                class="px-6 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 border border-gray-300 transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-6 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200">
                                Save Information
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for dynamic rows and form handling -->
<script>
    // Counter for generating unique IDs
    let scholarshipCounter = 0;
    
    // Initialize the table on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Setup add scholarship button
        document.getElementById('add-scholarship-btn').addEventListener('click', function() {
            addScholarshipRow();
        });
        
        // Add initial row
        addScholarshipRow();
    });
    
    function generateScholarshipId() {
        return 'scholarship_' + (++scholarshipCounter);
    }
    
    function addScholarshipRow() {
        const rowId = generateScholarshipId();
        const tableBody = document.getElementById('scholarship-body');
        
        const row = document.createElement('tr');
        row.id = rowId;
        row.innerHTML = `
            <td class="px-6 py-4">
                <textarea name="${rowId}_program" placeholder="Scholarship Program Description" rows="3"
                    class="w-full min-w-[200px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required></textarea>
            </td>
            <td class="px-6 py-4">
                <textarea name="${rowId}_course" placeholder="Course Details" rows="3"
                    class="w-full min-w-[200px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required></textarea>
            </td>
            <td class="px-6 py-4">
                <input type="number" name="${rowId}_beneficiaries" placeholder="Number of Beneficiaries" min="0" 
                    class="w-full min-w-[120px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
                <button type="button" onclick="removeRow('${rowId}')" 
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </td>
        `;
        
        tableBody.appendChild(row);
    }
    
    function removeRow(rowId) {
        const row = document.getElementById(rowId);
        if (row) {
            row.remove();
        }
    }
</script>
@endsection