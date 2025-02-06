{{-- 
    Tips for implementation:
    1. Create a MembershipController with store method
    2. Define the route in web.php: Route::post('/membership', [MembershipController::class, 'store'])->name('membership.store');
    3. Create a migration for the membership table
    4. Create a Membership model
    5. Add proper validation in the controller
--}}

@extends('layouts.form')

@section('form-content')
<div class="container mx-auto p-6">
    {{-- 
        Tip: Add validation error messages display
        You can loop through $errors variable provided by Laravel
    --}}
    @if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc list-inside">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- 
        Tip: Use old() helper to retain form values after failed validation
        The route name 'membership.store' should match your routes file
    --}}
    <form method="POST" action="#" class="space-y-8">
        @csrf
        
        {{-- Number of Members Section --}}
        <div>
            <h2 class="text-2xl font-bold mb-4">Number of Members</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Type/Status</th>
                            <th class="border p-2" colspan="2">2021</th>
                            <th class="border p-2" colspan="2">2022</th>
                            <th class="border p-2" colspan="2">2023</th>
                        </tr>
                        <tr class="bg-gray-100">
                            <th class="border p-2"></th>
                            @foreach(['2021', '2022', '2023'] as $year)
                                <th class="border p-2">M</th>
                                <th class="border p-2">F</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Define member types for easy maintenance
                            $memberTypes = [
                                'drivers' => 'Drivers',
                                'operators' => 'Member – Operator',
                                'allied_workers' => 'Allied Workers',
                                'others' => 'Others'
                            ];
                        @endphp

                        @foreach($memberTypes as $key => $label)
                        <tr>
                            <td class="border p-2">{{ $label }}</td>
                            @foreach(['2021', '2022', '2023'] as $year)
                                <td class="border p-2">
                                    <input type="number"
                                        name="members[{{ $key }}][{{ $year }}][male]"
                                        class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ old('members.'.$key.'.'.$year.'.male', 0) }}"
                                        min="0"
                                        data-type="member"
                                        data-year="{{ $year }}"
                                        data-gender="male">
                                </td>
                                <td class="border p-2">
                                    <input type="number"
                                        name="members[{{ $key }}][{{ $year }}][female]"
                                        class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ old('members.'.$key.'.'.$year.'.female', 0) }}"
                                        min="0"
                                        data-type="member"
                                        data-year="{{ $year }}"
                                        data-gender="female">
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                        <tr class="font-bold bg-gray-100">
                            <td class="border p-2">TOTAL</td>
                            @foreach(['2021', '2022', '2023'] as $year)
                                <td class="border p-2">
                                    <input type="number"
                                        name="members_total[{{ $year }}][male]"
                                        class="w-full font-bold border-gray-300 rounded"
                                        readonly
                                        data-total="member-{{ $year }}-male">
                                </td>
                                <td class="border p-2">
                                    <input type="number"
                                        name="members_total[{{ $year }}][female]"
                                        class="w-full font-bold border-gray-300 rounded"
                                        readonly
                                        data-total="member-{{ $year }}-female">
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Status of Employment Section --}}
        <div>
            <h2 class="text-2xl font-bold mb-4">Status of Employment</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Type of Employee</th>
                            <th class="border p-2" colspan="2">Probationary</th>
                            <th class="border p-2" colspan="2">Regular</th>
                        </tr>
                        <tr class="bg-gray-100">
                            <th class="border p-2"></th>
                            <th class="border p-2">M</th>
                            <th class="border p-2">F</th>
                            <th class="border p-2">M</th>
                            <th class="border p-2">F</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Define employment types
                            $employmentTypes = [
                                'drivers' => 'Drivers',
                                'management' => 'Management Staff',
                                'allied' => 'Allied Workers'
                            ];
                        @endphp

                        @foreach($employmentTypes as $key => $label)
                        <tr>
                            <td class="border p-2">{{ $label }}</td>
                            @foreach(['probationary', 'regular'] as $status)
                                <td class="border p-2">
                                    <input type="number"
                                        name="employment[{{ $key }}][{{ $status }}][male]"
                                        class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ old('employment.'.$key.'.'.$status.'.male', 0) }}"
                                        min="0"
                                        data-type="employment"
                                        data-status="{{ $status }}"
                                        data-gender="male">
                                </td>
                                <td class="border p-2">
                                    <input type="number"
                                        name="employment[{{ $key }}][{{ $status }}][female]"
                                        class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ old('employment.'.$key.'.'.$status.'.female', 0) }}"
                                        min="0"
                                        data-type="employment"
                                        data-status="{{ $status }}"
                                        data-gender="female">
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                        <tr class="font-bold bg-gray-100">
                            <td class="border p-2">TOTAL</td>
                            @foreach(['probationary', 'regular'] as $status)
                                <td class="border p-2">
                                    <input type="number"
                                        name="employment_total[{{ $status }}][male]"
                                        class="w-full font-bold border-gray-300 rounded"
                                        readonly
                                        data-total="employment-{{ $status }}-male">
                                </td>
                                <td class="border p-2">
                                    <input type="number"
                                        name="employment_total[{{ $status }}][female]"
                                        class="w-full font-bold border-gray-300 rounded"
                                        readonly
                                        data-total="employment-{{ $status }}-female">
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Special Type/Status Section --}}
        <div>
            <h2 class="text-2xl font-bold mb-4">Special Type/Status</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Special Type/Status</th>
                            <th class="border p-2">2021</th>
                            <th class="border p-2">2022</th>
                            <th class="border p-2">2023</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            // Define special types
                            $specialTypes = [
                                'pwd' => 'Persons with Disability (PWDs)',
                                'senior' => 'Senior Citizens'
                            ];
                        @endphp

                        @foreach($specialTypes as $key => $label)
                        <tr>
                            <td class="border p-2">{{ $label }}</td>
                            @foreach(['2021', '2022', '2023'] as $year)
                                <td class="border p-2">
                                    <input type="number"
                                        name="special[{{ $key }}][{{ $year }}]"
                                        class="w-full border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500"
                                        value="{{ old('special.'.$key.'.'.$year, 0) }}"
                                        min="0"
                                        data-type="special"
                                        data-year="{{ $year }}">
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                        <tr class="font-bold bg-gray-100">
                            <td class="border p-2">TOTAL</td>
                            @foreach(['2021', '2022', '2023'] as $year)
                                <td class="border p-2">
                                    <input type="number"
                                        name="special_total[{{ $year }}]"
                                        class="w-full font-bold border-gray-300 rounded"
                                        readonly
                                        data-total="special-{{ $year }}">
                                </td>
                            @endforeach
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Save Information
            </button>
        </div>
    </form>
</div>

@push('scripts')
<script>
    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function() {
        // Add input event listeners to all number inputs
        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', function() {
                calculateTotals();
            });
        });

        // Function to calculate all totals
        function calculateTotals() {
            calculateMembersTotals();
            calculateEmploymentTotals();
            calculateSpecialTotals();
        }

        // Calculate totals for members section
        function calculateMembersTotals() {
            const years = ['2021', '2022', '2023'];
            const genders = ['male', 'female'];

            years.forEach(year => {
                genders.forEach(gender => {
                    const inputs = document.querySelectorAll(`input[data-type="member"][data-year="${year}"][data-gender="${gender}"]`);
                    const total = Array.from(inputs).reduce((sum, input) => sum + (parseInt(input.value) || 0), 0);
                    document.querySelector(`input[data-total="member-${year}-${gender}"]`).value = total;
                });
            });
        }

        // Calculate totals for employment section
        function calculateEmploymentTotals() {
            const statuses = ['probationary', 'regular'];
            const genders = ['male', 'female'];

            statuses.forEach(status => {
                genders.forEach(gender => {
                    const inputs = document.querySelectorAll(`input[data-type="employment"][data-status="${status}"][data-gender="${gender}"]`);
                    const total = Array.from(inputs).reduce((sum, input) => sum + (parseInt(input.value) || 0), 0);
                    document.querySelector(`input[data-total="employment-${status}-${gender}"]`).value = total;
                });
            });
        }

        // Calculate totals for special section
        function calculateSpecialTotals() {
            const years = ['2021', '2022', '2023'];

            years.forEach(year => {
                const inputs = document.querySelectorAll(`input[data-type="special"][data-year="${year}"]`);
                const total = Array.from(inputs).reduce((sum, input) => sum + (parseInt(input.value) || 0), 0);
                document.querySelector(`input[data-total="special-${year}"]`).value = total;
            });
        }

        // Calculate initial totals
        calculateTotals();
    });
</script>
@endpush
@endsection