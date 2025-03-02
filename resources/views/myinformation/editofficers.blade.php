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
                        <h2 class="text-2xl font-bold text-gray-800">Cooperative Officers Information</h2>
                        <a href="#" class="text-gray-500 hover:text-gray-600">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </a>
                    </div>

                    <form action="#" method="POST" class="space-y-6">
                        @csrf
                        <!-- Officers Information Table -->
                        <div class="overflow-x-auto">
                            <!-- For both tables, change the table class to: -->
                            <table class="min-w-full bg-white border border-gray-200 rounded-lg table-fixed" id="officers-table">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Role <span class="text-red-500">*</span>
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Name <span class="text-red-500">*</span>
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Term in Office <span class="text-red-500">*</span>
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Contact No. <span class="text-red-500">*</span>
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Email <span class="text-red-500">*</span> 
                                        </th>
                                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                            Action <span class="text-red-500">*</span> 
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200" id="officers-body">
                                    <!-- Officer rows will be added here dynamically -->
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6" class="px-6 py-4">
                                            <button type="button" id="add-officer-btn" 
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                                Add Officer
                                            </button>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                        <!-- GAD Committee Section -->
                        <div class="mt-10">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">GAD Committee</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full bg-white border border-gray-200 rounded-lg" id="gad-committee-table">
                                    <thead>
                                        <tr class="bg-gray-50">
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                                Role <span class="text-red-500">*</span>
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                                Name <span class="text-red-500">*</span> 
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                                Term in Office <span class="text-red-500">*</span>
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                                Contact No. <span class="text-red-500">*</span>
                                            </th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                                Email <span class="text-red-500">*</span>
                                            </th>
                                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-b">
                                                Action <span class="text-red-500">*</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200" id="gad-committee-body">
                                        <!-- GAD Committee rows will be added here dynamically -->
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6" class="px-6 py-4">
                                                <button type="button" id="add-gad-member-btn" 
                                                        class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    Add GAD Committee Member
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <!-- Form Actions -->
                        <div class="flex items-center justify-end space-x-4 pt-6 border-t">
                            <a href="{{ route('officers') }}"
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
    // List of officer roles
    const officerRoles = [
        'Chairperson',
        'Vice-Chairperson',
        'Board Member',
        'General Manager',
        'Board Secretary',
        'Bookkeeper',
        'Treasurer',
        'Fleet Manager',
        'Terminal Operation Officer',
        'Safety Officer',
        'Other'
    ];
    
    // List of GAD Committee roles
    const gadRoles = [
        'GAD Committee Chairperson',
        'GAD Committee Secretary',
        'GAD Committee Member'
    ];
    
    // Counter for generating unique IDs
    let officerCounter = 0;
    let gadCounter = 0;
    
    // Initialize the tables on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Setup add officer button
        document.getElementById('add-officer-btn').addEventListener('click', function() {
            addOfficerRow();
        });
        
        // Setup add GAD member button
        document.getElementById('add-gad-member-btn').addEventListener('click', function() {
            addGadMemberRow();
        });
        
        // Add initial rows
        addOfficerRow(); // Add Chairperson row by default
        addGadMemberRow(); // Add GAD Chairperson row by default
    });
    
    function generateOfficerId() {
        return 'officer_' + (++officerCounter);
    }
    
    function generateGadId() {
        return 'gad_' + (++gadCounter);
    }
    
    function addOfficerRow() {
        const rowId = generateOfficerId();
        const tableBody = document.getElementById('officers-body');
        
        const row = document.createElement('tr');
        row.id = rowId;
        row.innerHTML = `
            <td class="px-6 py-4">
                <div class="space-y-2">
                    <select name="${rowId}_role" class="w-full min-w-[200px] px-4 py-3 text-base rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all duration-200" required>
                        <option value="">Select Role</option>
                        ${officerRoles.map(role => `<option value="${role}">${role}</option>`).join('')}
                    </select>
                    <div class="other-role-field" style="display:none;">
                        <input type="text" name="${rowId}_role_other" placeholder="Specify role required"
                            class="w-full min-w-[200px] px-4 py-3 text-base rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all duration-200">
                    </div>
                </div>
            </td>
            <td class="px-6 py-4">
                <input type="text" name="${rowId}_name" placeholder="Full Name" 
                    class="w-full min-w-[180px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
            </td>
            <td class="px-6 py-4">
                <input type="text" name="${rowId}_term" placeholder="e.g. 2022-2024" 
                    class="w-full min-w-[120px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
            </td>
            <td class="px-6 py-4">
                <input type="text" name="${rowId}_contact" placeholder="Contact Number" 
                    class="w-full min-w-[150px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
            </td>
            <td class="px-6 py-4">
                <input type="email" name="${rowId}_email" placeholder="Email Address" 
                    class="w-full min-w-[180px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
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
        
        // Add event listener for the role dropdown
        const select = row.querySelector('select[name="' + rowId + '_role"]');
        select.addEventListener('change', function() {
            const otherField = row.querySelector('.other-role-field');
            if (this.value === 'Other') {
                otherField.style.display = 'block';
            } else {
                otherField.style.display = 'none';
            }
        });
    }
    
    function addGadMemberRow() {
        const rowId = generateGadId();
        const tableBody = document.getElementById('gad-committee-body');
        
        const row = document.createElement('tr');
        row.id = rowId;
        row.innerHTML = `
            <td class="px-6 py-4">
                <div class="space-y-2">
                    <select name="${rowId}_role" class="w-full min-w-[200px] px-4 py-3 text-base rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 shadow-sm transition-all duration-200" required>
                        <option value="">Select Role</option>
                        ${gadRoles.map(role => `<option value="${role}">${role}</option>`).join('')}
                    </select>
                </div>
            </td>
            <td class="px-6 py-4">
                <input type="text" name="${rowId}_name" placeholder="Full Name" 
                    class="w-full min-w-[180px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
            </td>
            <td class="px-6 py-4">
                <input type="text" name="${rowId}_term" placeholder="e.g. 2022-2024" 
                    class="w-full min-w-[120px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
            </td>
            <td class="px-6 py-4">
                <input type="text" name="${rowId}_contact" placeholder="Contact Number" 
                    class="w-full min-w-[150px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
            </td>
            <td class="px-6 py-4">
                <input type="email" name="${rowId}_email" placeholder="Email Address" 
                    class="w-full min-w-[180px] px-3 py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-100 focus:border-blue-400 transition-all duration-200" required>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-center">
                <button type="button" onclick="removeGadRow('${rowId}')" 
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
    function removeGadRow(rowId) {
        const row = document.getElementById(rowId);
        if (row) {
            row.remove();
        }
    }
</script>
@endsection