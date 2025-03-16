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
                        <h2 class="text-2xl font-bold text-gray-800">Transport Units Data</h2>
                        <a href="#" class="text-gray-500 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>

                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        
                        <!-- Year Selection -->
                        <div class="mb-6">
                            <label class="flex items-center text-sm font-medium text-gray-700 mb-2">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Year <span class="text-red-500">*</span>
                            </label>
                            <select name="year" class="w-full px-4 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
                                <option value="2023">2023</option>
                                <option value="2022">2022</option>
                                <option value="2021">2021</option>
                            </select>
                        </div>

                        <!-- Transport Units Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg" id="transport-units-table">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Mode/Type of Unit
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Cooperatively<br>Owned Units
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Individually<br>Owned Units
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Total
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200" id="transport-units-body">
                                    <!-- Row template will be added here dynamically -->
                                </tbody>
                                <tfoot>
                                    <!-- Grand Total -->
                                    <tr class="bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            GRAND TOTAL
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            <input type="number" name="grand_total_coop" value="{{ old('grand_total_coop', $data->grand_total_coop ?? 0) }}"
                                                   class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 font-bold focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                   readonly id="grand_total_coop">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            <input type="number" name="grand_total_individual" value="{{ old('grand_total_individual', $data->grand_total_individual ?? 0) }}"
                                                   class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 font-bold focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                   readonly id="grand_total_individual">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            <input type="number" name="grand_total" value="{{ old('grand_total', $data->grand_total ?? 0) }}"
                                                   class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 font-bold focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                   readonly id="grand_total">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            <button type="button" id="add-row-btn" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Add Row
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                            <a href="{{ route('units') }}"
                                class="px-6 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 border border-gray-300 transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-6 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200">
                                Save Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for dynamic rows and automatic calculations -->
<script>
    // Initial data - can be populated from database
    const initialData = [
        { id: 'pujs', name: 'Traditional PUJs', coop: {{ $data->pujs_coop ?? 0 }}, individual: {{ $data->pujs_individual ?? 0 }}, total: {{ $data->pujs_total ?? 0 }} },
        { id: 'mpuvs', name: 'Modern PUVs (MPUVs)', coop: {{ $data->mpuvs_coop ?? 0 }}, individual: {{ $data->mpuvs_individual ?? 0 }}, total: {{ $data->mpuvs_total ?? 0 }} },
        { id: 'uvexpress', name: 'UV Express', coop: {{ $data->uvexpress_coop ?? 0 }}, individual: {{ $data->uvexpress_individual ?? 0 }}, total: {{ $data->uvexpress_total ?? 0 }} },
        { id: 'taxi', name: 'Taxi', coop: {{ $data->taxi_coop ?? 0 }}, individual: {{ $data->taxi_individual ?? 0 }}, total: {{ $data->taxi_total ?? 0 }} },
        { id: 'bus', name: 'Bus', coop: {{ $data->bus_coop ?? 0 }}, individual: {{ $data->bus_individual ?? 0 }}, total: {{ $data->bus_total ?? 0 }} },
        { id: 'tourist', name: 'Tourist Transport', coop: {{ $data->tourist_coop ?? 0 }}, individual: {{ $data->tourist_individual ?? 0 }}, total: {{ $data->tourist_total ?? 0 }} }
    ];
    
    // List of available transport unit types
    const transportTypes = [
        'Traditional PUJs',
        'Modern PUVs (MPUVs)',
        'UV Express',
        'Taxi',
        'Bus',
        'Tourist Transport',
        'Others'
    ];
    
    // Counter for generating unique IDs
    let rowCounter = initialData.length;
    
    // Initialize the table on page load
    document.addEventListener('DOMContentLoaded', function() {
        const tableBody = document.getElementById('transport-units-body');
        
        // Add initial rows
        initialData.forEach(rowData => {
            addTableRow(rowData.id, rowData.name, rowData.coop, rowData.individual);
        });
        
        // Add "Others" row with specify field if it exists in the data
        if ("{{ $data->others_specify ?? '' }}") {
            addOthersRow("{{ $data->others_specify ?? '' }}", {{ $data->others_coop ?? 0 }}, {{ $data->others_individual ?? 0 }});
        }
        
        // Setup add row button
        document.getElementById('add-row-btn').addEventListener('click', function() {
            addNewRow();
        });
        
        // Calculate totals
        updateGrandTotal();
    });
    
    function generateUniqueId() {
        return 'row_' + (++rowCounter);
    }
    
    function addNewRow() {
        const rowId = generateUniqueId();
        const tableBody = document.getElementById('transport-units-body');
        
        const row = document.createElement('tr');
        row.id = rowId;
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                <select name="${rowId}_type" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 transport-type-select">
                    <option value="" required>Select Transport Type</option>
                    ${transportTypes.map(type => `<option value="${type}">${type}</option>`).join('')}
                </select>
                <div class="mt-2 others-field" style="display:none;">
                    <input type="text" name="${rowId}_specify" placeholder="Please specify" 
                           class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200">
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <input type="number" name="${rowId}_coop" value="0" 
                       class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                       min="0" onchange="updateRowTotal('${rowId}')">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <input type="number" name="${rowId}_individual" value="0"
                       class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                       min="0" onchange="updateRowTotal('${rowId}')">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <input type="number" name="${rowId}_total" value="0"
                       class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                       readonly id="${rowId}_total">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <button type="button" onclick="removeRow('${rowId}')" 
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </td>
        `;
        
        tableBody.appendChild(row);
        
        // Add event listener for the transport type dropdown
        const select = row.querySelector('.transport-type-select');
        select.addEventListener('change', function() {
            const othersField = row.querySelector('.others-field');
            if (this.value === 'Others') {
                othersField.style.display = 'block';
            } else {
                othersField.style.display = 'none';
            }
        });
    }
    
    function addTableRow(id, name, coopValue, individualValue) {
        const tableBody = document.getElementById('transport-units-body');
        
        const row = document.createElement('tr');
        row.id = id;
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                <select name="${id}_type" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 transport-type-select">
                    ${transportTypes.map(type => `<option value="${type}" ${type === name ? 'selected' : ''}>${type}</option>`).join('')}
                </select>
                <div class="mt-2 others-field" style="display:none;">
                    <input type="text" name="${id}_specify" placeholder="Please specify" 
                           class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200">
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <input type="number" name="${id}_coop" value="${coopValue}" 
                       class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                       min="0" onchange="updateRowTotal('${id}')">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <input type="number" name="${id}_individual" value="${individualValue}"
                       class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                       min="0" onchange="updateRowTotal('${id}')">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <input type="number" name="${id}_total" value="${parseInt(coopValue) + parseInt(individualValue)}"
                       class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                       readonly id="${id}_total">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <button type="button" onclick="removeRow('${id}')" 
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </td>
        `;
        
        tableBody.appendChild(row);
        
        // Add event listener for the transport type dropdown
        const select = row.querySelector('.transport-type-select');
        select.addEventListener('change', function() {
            const othersField = row.querySelector('.others-field');
            if (this.value === 'Others') {
                othersField.style.display = 'block';
            } else {
                othersField.style.display = 'none';
            }
        });
    }
    
    function addOthersRow(specifyValue, coopValue, individualValue) {
        const id = 'others';
        const tableBody = document.getElementById('transport-units-body');
        
        const row = document.createElement('tr');
        row.id = id;
        row.innerHTML = `
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                <select name="${id}_type" class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200 transport-type-select">
                    ${transportTypes.map(type => `<option value="${type}" ${type === 'Others' ? 'selected' : ''}>${type}</option>`).join('')}
                </select>
                <div class="mt-2 others-field" style="display:block;">
                    <input type="text" name="${id}_specify" placeholder="Please specify" value="${specifyValue}"
                           class="w-full px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200">
                </div>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <input type="number" name="${id}_coop" value="${coopValue}" 
                       class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                       min="0" onchange="updateRowTotal('${id}')">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <input type="number" name="${id}_individual" value="${individualValue}"
                       class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                       min="0" onchange="updateRowTotal('${id}')">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <input type="number" name="${id}_total" value="${parseInt(coopValue) + parseInt(individualValue)}"
                       class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                       readonly id="${id}_total">
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <button type="button" onclick="removeRow('${id}')" 
                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </td>
        `;
        
        tableBody.appendChild(row);
        
        // Add event listener for the transport type dropdown
        const select = row.querySelector('.transport-type-select');
        select.addEventListener('change', function() {
            const othersField = row.querySelector('.others-field');
            if (this.value === 'Others') {
                othersField.style.display = 'block';
            } else {
                othersField.style.display = 'none';
            }
        });
    }
    
    function removeRow(rowId) {
        const row = document.getElementById(rowId);
        if (row) {
            row.remove();
            updateGrandTotal();
        }
    }
    
    function updateRowTotal(rowId) {
        const coop = parseInt(document.getElementsByName(rowId + '_coop')[0].value) || 0;
        const individual = parseInt(document.getElementsByName(rowId + '_individual')[0].value) || 0;
        document.getElementById(rowId + '_total').value = coop + individual;
        
        updateGrandTotal();
    }
    
    function updateGrandTotal() {
        let totalCoop = 0;
        let totalIndividual = 0;
        
        // Sum up all cooperative units
        document.querySelectorAll('input[name$="_coop"]').forEach(input => {
            if (!input.name.includes('grand_total')) {
                totalCoop += parseInt(input.value) || 0;
            }
        });
        
        // Sum up all individual units
        document.querySelectorAll('input[name$="_individual"]').forEach(input => {
            if (!input.name.includes('grand_total')) {
                totalIndividual += parseInt(input.value) || 0;
            }
        });
        
        // Update grand totals
        document.getElementById('grand_total_coop').value = totalCoop;
        document.getElementById('grand_total_individual').value = totalIndividual;
        document.getElementById('grand_total').value = totalCoop + totalIndividual;
    }
</script>
@endsection