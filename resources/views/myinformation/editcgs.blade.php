@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-12 gap-6">

            {{-- Sidebar  --}}
            @include('components.sidebar')

            {{-- Enhanced Main Content --}}
            <div class="col-span-9">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
                    <div class="flex items-center justify-between mb-8">
                        <h2 class="text-2xl font-bold text-gray-800">Certificate of Good Standing Details</h2>
                        <a href="#" class="text-gray-500 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>

                    <form action="#" method="POST" class="space-y-6" id="cgsForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- CGS Records Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="border-b">
                                        <th class="py-3 px-4 text-left font-medium text-gray-700">Year <span class="text-red-500">*</span></th>
                                        <th class="py-3 px-4 text-left font-medium text-gray-700">CGS No. <span class="text-red-500">*</span></th>
                                        <th class="py-3 px-4 text-left font-medium text-gray-700">Date Issued <span class="text-red-500">*</span></th>
                                        <th class="py-3 px-4 text-left font-medium text-gray-700">Expiration Date <span class="text-red-500">*</span></th>
                                    </tr>
                                </thead>
                                <tbody id="cgsTableBody">
                                    <!-- Table rows will be dynamically generated here -->
                                </tbody>
                            </table>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                            <a href="{{ route('cgs') }}"
                               class="px-6 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 border border-gray-300 transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-6 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200">
                                Save CGS Details
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get current year
        const currentYear = new Date().getFullYear();
        const tableBody = document.getElementById('cgsTableBody');
        
        // Generate rows for the last 3 years
        for (let i = 0; i < 3; i++) {
            const year = currentYear - i;
            const row = document.createElement('tr');
            
            if (i < 2) {
                row.classList.add('border-b');
            }
            
            row.innerHTML = `
                <td class="py-3 px-4">
                    <input type="text" value="${year}" name="year_${i}" 
                           class="px-4 py-2 rounded-lg border border-gray-300 bg-gray-100" readonly>
                </td>
                <td class="py-3 px-4">
                    <input type="text" name="cgs_no_${i}" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                           placeholder="Enter CGS No."
                           pattern="(\\d{4}-\\d{3}|\\d{4}|\\d{5})"
                           title="Enter in format YYYY-XXX, XXXX, or XXXXX" required>
                </td>
                <td class="py-3 px-4">
                    <input type="date" name="date_issued_${i}" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
                </td>
                <td class="py-3 px-4">
                    <input type="date" name="expiration_date_${i}" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
                </td>
            `;
            
            tableBody.appendChild(row);
        }
        
        // Form validation
        document.getElementById('cgsForm').addEventListener('submit', function(event) {
            let isValid = true;
            
            // Validate CGS numbers
            for (let i = 0; i < 3; i++) {
                const cgsInput = document.querySelector(`[name="cgs_no_${i}"]`);
                const cgsValue = cgsInput.value.trim();
                
                if (cgsValue !== "" && !(/^(\d{4}-\d{3}|\d{4}|\d{5})$/.test(cgsValue))) {
                    isValid = false;
                    cgsInput.classList.add('border-red-500');
                    
                    // Create error message if it doesn't exist
                    let errorMsg = cgsInput.parentNode.querySelector('.text-red-500');
                    if (!errorMsg) {
                        errorMsg = document.createElement('p');
                        errorMsg.className = 'mt-1 text-sm text-red-500';
                        errorMsg.textContent = 'Format must be YYYY-XXX, XXXX, or XXXXX';
                        cgsInput.parentNode.appendChild(errorMsg);
                    }
                } else {
                    cgsInput.classList.remove('border-red-500');
                    const errorMsg = cgsInput.parentNode.querySelector('.text-red-500');
                    if (errorMsg) {
                        errorMsg.remove();
                    }
                }
            }
            
            if (!isValid) {
                event.preventDefault();
            }
        });
        
        // Clear validation errors on input change
        document.querySelectorAll('input[name^="cgs_no_"]').forEach(input => {
            input.addEventListener('input', function() {
                this.classList.remove('border-red-500');
                const errorMsg = this.parentNode.querySelector('.text-red-500');
                if (errorMsg) {
                    errorMsg.remove();
                }
            });
        });
    });
</script>
@endsection