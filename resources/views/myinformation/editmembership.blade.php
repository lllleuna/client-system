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
                        <h2 class="text-2xl font-bold text-gray-800">Member Categories Data</h2>
                        <a href="#" class="text-gray-500 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>

                    <form action="#" method="POST" class="space-y-6" id="memberCategoriesForm" novalidate>
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
                                <option value="">Select Year</option>
                                <option value="2025">2025</option>
                                <option value="2024">2024</option>
                                <option value="2023">2023</option>
                            </select>
                            <div class="hidden text-red-500 text-sm mt-1" id="yearError">Please select a year</div>
                        </div>

                        <!-- Member Categories Table -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Member Category
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Male
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Female
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Total
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <!-- Drivers -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                                            Drivers
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="input-group">
                                                <input type="number" name="drivers_male" value="{{ old('drivers_male', $data->drivers_male ?? 0) }}" 
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    min="0" onchange="updateTotal('drivers')" required>
                                                <div class="hidden text-red-500 text-sm mt-1" id="drivers_maleError">Please fill this field</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="input-group">
                                                <input type="number" name="drivers_female" value="{{ old('drivers_female', $data->drivers_female ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    min="0" onchange="updateTotal('drivers')" required>
                                                <div class="hidden text-red-500 text-sm mt-1" id="drivers_femaleError">Please fill this field</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <input type="number" name="drivers_total" value="{{ old('drivers_total', $data->drivers_total ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    readonly id="drivers_total">
                                        </td>
                                    </tr>

                                    <!-- Member - Operators -->
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                                            Member – Operators
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="input-group">
                                                <input type="number" name="operators_male" value="{{ old('operators_male', $data->operators_male ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    min="0" onchange="updateTotal('operators')" required>
                                                <div class="hidden text-red-500 text-sm mt-1" id="operators_maleError">Please fill this field</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="input-group">
                                                <input type="number" name="operators_female" value="{{ old('operators_female', $data->operators_female ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    min="0" onchange="updateTotal('operators')" required>
                                                <div class="hidden text-red-500 text-sm mt-1" id="operators_femaleError">Please fill this field</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <input type="number" name="operators_total" value="{{ old('operators_total', $data->operators_total ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    readonly id="operators_total">
                                        </td>
                                    </tr>

                                    <!-- Allied Workers -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-700">
                                            Allied Workers<br/>
                                            <span class="text-xs text-gray-500">(Terminal Operation Officer, Liaison Officer, Dispatcher, Safety Officer, etc.)</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="input-group">
                                                <input type="number" name="allied_male" value="{{ old('allied_male', $data->allied_male ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    min="0" onchange="updateTotal('allied')" required>
                                                <div class="hidden text-red-500 text-sm mt-1" id="allied_maleError">Please fill this field</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="input-group">
                                                <input type="number" name="allied_female" value="{{ old('allied_female', $data->allied_female ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    min="0" onchange="updateTotal('allied')" required>
                                                <div class="hidden text-red-500 text-sm mt-1" id="allied_femaleError">Please fill this field</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <input type="number" name="allied_total" value="{{ old('allied_total', $data->allied_total ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    readonly id="allied_total">
                                        </td>
                                    </tr>

                                    <!-- Others -->
                                    <tr>
                                        <td class="px-6 py-4 text-sm font-medium text-gray-700">
                                            Others<br/>
                                            <span class="text-xs text-gray-500">(Members from credit cooperatives if multi-purpose)</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="input-group">
                                                <input type="number" name="others_male" value="{{ old('others_male', $data->others_male ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    min="0" onchange="updateTotal('others')" required>
                                                <div class="hidden text-red-500 text-sm mt-1" id="others_maleError">Please fill this field</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="input-group">
                                                <input type="number" name="others_female" value="{{ old('others_female', $data->others_female ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    min="0" onchange="updateTotal('others')" required>
                                                <div class="hidden text-red-500 text-sm mt-1" id="others_femaleError">Please fill this field</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <input type="number" name="others_total" value="{{ old('others_total', $data->others_total ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    readonly id="others_total">
                                        </td>
                                    </tr>

                                    <!-- Grand Total -->
                                    <tr class="bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            TOTAL MEMBERS
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            <input type="number" name="grand_total_male" value="{{ old('grand_total_male', $data->grand_total_male ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 font-bold focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    readonly id="grand_total_male">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            <input type="number" name="grand_total_female" value="{{ old('grand_total_female', $data->grand_total_female ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 font-bold focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    readonly id="grand_total_female">
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                            <input type="number" name="grand_total" value="{{ old('grand_total', $data->grand_total ?? 0) }}"
                                                    class="w-24 px-3 py-2 rounded-lg border border-gray-300 bg-gray-50 font-bold focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200"
                                                    readonly id="grand_total">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                            <a href="{{ route('membership') }}"
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

<!-- JavaScript for automatic calculations and validation -->
<script>
    function updateTotal(category) {
        const male = parseInt(document.getElementsByName(category + '_male')[0].value) || 0;
        const female = parseInt(document.getElementsByName(category + '_female')[0].value) || 0;
        document.getElementById(category + '_total').value = male + female;
        
        updateGrandTotal();
    }
    
    function updateGrandTotal() {
        let totalMale = 0;
        let totalFemale = 0;
        
        // Sum up all male counts
        document.querySelectorAll('input[name$="_male"]').forEach(input => {
            if (!input.name.includes('grand_total')) {
                totalMale += parseInt(input.value) || 0;
            }
        });
        
        // Sum up all female counts
        document.querySelectorAll('input[name$="_female"]').forEach(input => {
            if (!input.name.includes('grand_total')) {
                totalFemale += parseInt(input.value) || 0;
            }
        });
        
        // Update grand totals
        document.getElementById('grand_total_male').value = totalMale;
        document.getElementById('grand_total_female').value = totalFemale;
        document.getElementById('grand_total').value = totalMale + totalFemale;
    }
    
    // Validate form on submit
    document.getElementById('memberCategoriesForm').addEventListener('submit', function(e) {
        let isValid = true;
        
        // Validate year selection
        const yearSelect = document.getElementsByName('year')[0];
        if (!yearSelect.value) {
            document.getElementById('yearError').classList.remove('hidden');
            isValid = false;
        } else {
            document.getElementById('yearError').classList.add('hidden');
        }
        
        // Validate all number inputs
        const requiredInputs = document.querySelectorAll('input[required]');
        requiredInputs.forEach(input => {
            const errorElement = document.getElementById(input.name + 'Error');
            if (!input.value || isNaN(parseInt(input.value))) {
                if (errorElement) {
                    errorElement.classList.remove('hidden');
                }
                isValid = false;
            } else {
                if (errorElement) {
                    errorElement.classList.add('hidden');
                }
            }
        });
        
        // Prevent form submission if validation fails
        if (!isValid) {
            e.preventDefault();
            // Scroll to the first error
            const firstError = document.querySelector('.text-red-500:not(.hidden)');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
    
    // Add input validation on blur for all required fields
    document.querySelectorAll('input[required], select[required]').forEach(input => {
        input.addEventListener('blur', function() {
            const errorElement = document.getElementById(this.name + 'Error');
            if (errorElement) {
                if (!this.value || (this.type === 'number' && isNaN(parseInt(this.value)))) {
                    errorElement.classList.remove('hidden');
                } else {
                    errorElement.classList.add('hidden');
                }
            }
        });
        
        // Clear error message when user starts typing
        input.addEventListener('input', function() {
            const errorElement = document.getElementById(this.name + 'Error');
            if (errorElement) {
                errorElement.classList.add('hidden');
            }
        });
    });
    
    // Initialize totals on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateTotal('drivers');
        updateTotal('operators');
        updateTotal('allied');
        updateTotal('others');
    });
</script>
@endsection