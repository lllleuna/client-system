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
                        <h2 class="text-2xl font-bold text-gray-800">Status of Employment</h2>
                        <a href="#" class="text-gray-500 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>

                    <p class="text-gray-600 mb-6">For Salaried/Waged Employees Only</p>

                    <form action="#" method="POST">
                        @csrf
                        
                        <div class="mb-8">
                            <table class="w-full border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 border-b">
                                        <th class="py-3 px-4 text-left text-sm font-medium text-gray-700">Category</th>
                                        <th class="py-3 px-4 text-center text-sm font-medium text-gray-700" colspan="2">Probationary</th>
                                        <th class="py-3 px-4 text-center text-sm font-medium text-gray-700" colspan="2">Regular</th>
                                        <th class="py-3 px-4 text-center text-sm font-medium text-gray-700">Total</th>
                                    </tr>
                                    <tr class="bg-gray-50 border-b">
                                        <th class="py-2 px-4 text-left text-sm font-medium text-gray-700"></th>
                                        <th class="py-2 px-4 text-center text-sm font-medium text-gray-700">Male</th>
                                        <th class="py-2 px-4 text-center text-sm font-medium text-gray-700">Female</th>
                                        <th class="py-2 px-4 text-center text-sm font-medium text-gray-700">Male</th>
                                        <th class="py-2 px-4 text-center text-sm font-medium text-gray-700">Female</th>
                                        <th class="py-2 px-4 text-center text-sm font-medium text-gray-700"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Drivers -->
                                    <tr class="border-b">
                                        <td class="py-3 px-4 text-sm text-gray-700">DRIVERS</td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="drivers_prob_male" min="0" value="{{ old('drivers_prob_male', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="drivers_prob_female" min="0" value="{{ old('drivers_prob_female', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="drivers_reg_male" min="0" value="{{ old('drivers_reg_male', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="drivers_reg_female" min="0" value="{{ old('drivers_reg_female', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="drivers_total" disabled readonly 
                                                   class="w-full px-3 py-2 rounded bg-gray-50 border border-gray-300">
                                        </td>
                                    </tr>
                                    
                                    <!-- Management Staff -->
                                    <tr class="border-b">
                                        <td class="py-3 px-4 text-sm text-gray-700">MANAGEMENT STAFF</td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="management_prob_male" min="0" value="{{ old('management_prob_male', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="management_prob_female" min="0" value="{{ old('management_prob_female', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="management_reg_male" min="0" value="{{ old('management_reg_male', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="management_reg_female" min="0" value="{{ old('management_reg_female', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="management_total" disabled readonly 
                                                   class="w-full px-3 py-2 rounded bg-gray-50 border border-gray-300">
                                        </td>
                                    </tr>
                                    
                                    <!-- Allied Workers -->
                                    <tr class="border-b">
                                        <td class="py-3 px-4 text-sm text-gray-700">ALLIED WORKERS</td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="allied_prob_male" min="0" value="{{ old('allied_prob_male', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="allied_prob_female" min="0" value="{{ old('allied_prob_female', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="allied_reg_male" min="0" value="{{ old('allied_reg_male', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="allied_reg_female" min="0" value="{{ old('allied_reg_female', 0) }}" 
                                                   class="w-full px-3 py-2 rounded border border-gray-300 focus:ring-blue-100 focus:border-blue-400">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="allied_total" disabled readonly 
                                                   class="w-full px-3 py-2 rounded bg-gray-50 border border-gray-300">
                                        </td>
                                    </tr>
                                    
                                    <!-- Totals -->
                                    <tr class="bg-gray-50">
                                        <td class="py-3 px-4 font-medium text-gray-700">TOTAL</td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="total_prob_male" disabled readonly 
                                                   class="w-full px-3 py-2 rounded bg-gray-100 border border-gray-300">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="total_prob_female" disabled readonly 
                                                   class="w-full px-3 py-2 rounded bg-gray-100 border border-gray-300">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="total_reg_male" disabled readonly 
                                                   class="w-full px-3 py-2 rounded bg-gray-100 border border-gray-300">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="total_reg_female" disabled readonly 
                                                   class="w-full px-3 py-2 rounded bg-gray-100 border border-gray-300">
                                        </td>
                                        <td class="py-3 px-4">
                                            <input type="number" name="grand_total" disabled readonly 
                                                   class="w-full px-3 py-2 rounded bg-gray-100 border border-gray-300 font-bold">
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4 text-gray-600 text-sm mb-8">
                            <p><strong>Allied Workers</strong> include: Terminal Operation Officer, Liaison Officer, Dispatcher, Safety Officer, Mechanic, Helper, Conductor, PAO, Inventory Custodian, etc.</p>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                            <a href="#" class="px-6 py-2.5 rounded-lg text-gray-700 hover:bg-gray-50 border border-gray-300 transition-all duration-200">
                                Cancel
                            </a>
                            <button type="submit" class="px-6 py-2.5 rounded-lg bg-blue-600 text-white hover:bg-blue-700 transition-all duration-200">
                                Save
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
    // Get all input fields
    const inputs = document.querySelectorAll('input[type="number"]:not([readonly])');
    
    // Add event listeners to all input fields
    inputs.forEach(input => {
        input.addEventListener('input', calculateTotals);
    });
    
    // Initial calculation
    calculateTotals();
    
    function calculateTotals() {
        // Calculate row totals
        calculateRowTotal('drivers');
        calculateRowTotal('management');
        calculateRowTotal('allied');
        
        // Calculate column totals
        calculateColumnTotal('prob_male');
        calculateColumnTotal('prob_female');
        calculateColumnTotal('reg_male');
        calculateColumnTotal('reg_female');
        
        // Calculate grand total
        calculateGrandTotal();
    }
    
    function calculateRowTotal(category) {
        const probMale = parseInt(document.querySelector(`input[name="${category}_prob_male"]`).value) || 0;
        const probFemale = parseInt(document.querySelector(`input[name="${category}_prob_female"]`).value) || 0;
        const regMale = parseInt(document.querySelector(`input[name="${category}_reg_male"]`).value) || 0;
        const regFemale = parseInt(document.querySelector(`input[name="${category}_reg_female"]`).value) || 0;
        
        const total = probMale + probFemale + regMale + regFemale;
        document.querySelector(`input[name="${category}_total"]`).value = total;
    }
    
    function calculateColumnTotal(column) {
        const drivers = parseInt(document.querySelector(`input[name="drivers_${column}"]`).value) || 0;
        const management = parseInt(document.querySelector(`input[name="management_${column}"]`).value) || 0;
        const allied = parseInt(document.querySelector(`input[name="allied_${column}"]`).value) || 0;
        
        const total = drivers + management + allied;
        document.querySelector(`input[name="total_${column}"]`).value = total;
    }
    
    function calculateGrandTotal() {
        const driversTotal = parseInt(document.querySelector('input[name="drivers_total"]').value) || 0;
        const managementTotal = parseInt(document.querySelector('input[name="management_total"]').value) || 0;
        const alliedTotal = parseInt(document.querySelector('input[name="allied_total"]').value) || 0;
        
        const grandTotal = driversTotal + managementTotal + alliedTotal;
        document.querySelector('input[name="grand_total"]').value = grandTotal;
    }
});
</script>
@endsection