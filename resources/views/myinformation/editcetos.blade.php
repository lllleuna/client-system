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
                        <h2 class="text-2xl font-bold text-gray-800">CETOS Monitoring</h2>
                        <a href="#" class="text-gray-500 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>

                    <form action="#" method="POST" class="space-y-6" id="cetosForm">
                        @csrf
                        @method('PUT')
                        
                        <!-- CETOS Monitoring Table -->
                        <div class="overflow-x-auto">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="border-b">
                                        <th class="py-3 px-4 text-left font-medium text-gray-700">Year <span class="text-red-500">*</span> </th>
                                        <th class="py-3 px-4 text-left font-medium text-gray-700">With CETOS <span class="text-red-500">*</span> </th>
                                        <th class="py-3 px-4 text-left font-medium text-gray-700">Without CETOS <span class="text-red-500">*</span> </th>
                                        <th class="py-3 px-4 text-left font-medium text-gray-700">TOTAL</th>
                                    </tr>
                                </thead>
                                <tbody id="cetosTableBody">
                                    <!-- Table rows will be dynamically generated here -->
                                </tbody>
                            </table>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                            <a href="{{ route('cetos') }}"
                               class="px-6 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 border border-gray-300 transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-6 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200">
                                Save CETOS Monitoring
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
        const tableBody = document.getElementById('cetosTableBody');
        
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
                           class="px-4 py-2 rounded-lg border border-gray-300 bg-gray-100" readonly required>
                </td>
                <td class="py-3 px-4">
                    <input type="number" name="with_cetos_${i}" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                           placeholder="Enter count"
                           min="0"
                           onchange="calculateTotal(${i})" required >
                </td>
                <td class="py-3 px-4">
                    <input type="number" name="without_cetos_${i}" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                           placeholder="Enter count"
                           min="0"
                           onchange="calculateTotal(${i})" required>
                </td>
                <td class="py-3 px-4">
                    <input type="number" name="total_${i}" 
                           class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-gray-100" 
                           readonly>
                </td>
            `;
            
            tableBody.appendChild(row);
        }
        
        // Function to calculate the total
        window.calculateTotal = function(rowIndex) {
            const withCetos = parseInt(document.querySelector(`[name="with_cetos_${rowIndex}"]`).value) || 0;
            const withoutCetos = parseInt(document.querySelector(`[name="without_cetos_${rowIndex}"]`).value) || 0;
            const totalField = document.querySelector(`[name="total_${rowIndex}"]`);
            
            totalField.value = withCetos + withoutCetos;
        };
        
        // Form validation
        document.getElementById('cetosForm').addEventListener('submit', function(event) {
            let isValid = true;
            
            // Validate numeric values
            for (let i = 0; i < 3; i++) {
                const withCetosInput = document.querySelector(`[name="with_cetos_${i}"]`);
                const withoutCetosInput = document.querySelector(`[name="without_cetos_${i}"]`);
                
                // Check if inputs are valid numbers
                if (withCetosInput.value && (isNaN(withCetosInput.value) || parseInt(withCetosInput.value) < 0)) {
                    isValid = false;
                    withCetosInput.classList.add('border-red-500');
                    
                    // Create error message if it doesn't exist
                    let errorMsg = withCetosInput.parentNode.querySelector('.text-red-500');
                    if (!errorMsg) {
                        errorMsg = document.createElement('p');
                        errorMsg.className = 'mt-1 text-sm text-red-500';
                        errorMsg.textContent = 'Please enter a valid positive number';
                        withCetosInput.parentNode.appendChild(errorMsg);
                    }
                } else {
                    withCetosInput.classList.remove('border-red-500');
                    const errorMsg = withCetosInput.parentNode.querySelector('.text-red-500');
                    if (errorMsg) {
                        errorMsg.remove();
                    }
                }
                
                if (withoutCetosInput.value && (isNaN(withoutCetosInput.value) || parseInt(withoutCetosInput.value) < 0)) {
                    isValid = false;
                    withoutCetosInput.classList.add('border-red-500');
                    
                    // Create error message if it doesn't exist
                    let errorMsg = withoutCetosInput.parentNode.querySelector('.text-red-500');
                    if (!errorMsg) {
                        errorMsg = document.createElement('p');
                        errorMsg.className = 'mt-1 text-sm text-red-500';
                        errorMsg.textContent = 'Please enter a valid positive number';
                        withoutCetosInput.parentNode.appendChild(errorMsg);
                    }
                } else {
                    withoutCetosInput.classList.remove('border-red-500');
                    const errorMsg = withoutCetosInput.parentNode.querySelector('.text-red-500');
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
        document.querySelectorAll('input[name^="with_cetos_"], input[name^="without_cetos_"]').forEach(input => {
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