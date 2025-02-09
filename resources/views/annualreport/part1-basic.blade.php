@extends('layouts.form')
@section('form-content')
<div class="card w-full">
    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            {{-- Organization Basic Information --}}
            <div class="col-span-2">
                <h3 class="text-lg font-semibold mb-4">Basic Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form-input 
                        label="NAME OF TC (IN FULL)" 
                        name="tc_name" 
                        value="{{ old('tc_name') }}" 
                        required 
                    />
                    <x-form-input 
                        label="BUSINESS ADDRESS" 
                        name="business_address" 
                        value="{{ old('business_address') }}" 
                        required 
                    />
                </div>
            </div>

            {{-- Contact Information --}}
            <div class="col-span-2">
                <h3 class="text-lg font-semibold mb-4">Contact Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form-input 
                        label="OFFICIAL EMAIL ADDRESS" 
                        name="email" 
                        value="{{ old('email') }}" 
                        type="email" 
                        required 
                    />
                    <div class="grid grid-cols-2 gap-4">
                        <x-form-input 
                            label="OFFICIAL CONTACT NO." 
                            name="contact_number" 
                            value="{{ old('contact_number') }}" 
                        />
                        <x-form-input 
                            label="CONTACT PERSON" 
                            name="contact_person" 
                            value="{{ old('contact_person') }}" 
                        />
                    </div>
                </div>
            </div>

            {{-- Registration Information --}}
            <div class="col-span-2">
                <h3 class="text-lg font-semibold mb-4">Registration Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="grid grid-cols-2 gap-4">
                        <x-form-input 
                            label="OTC ACCREDITATION NO." 
                            name="otc_accreditation" 
                            value="{{ old('otc_accreditation') }}" 
                        />
                        <x-form-input 
                            label="DATE ACCREDITED (OTC ACCREDITATION)" 
                            name="date_accredited" 
                            value="{{ old('date_accredited') }}" 
                            type="date" 
                        />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-form-input 
                            label="CDA REGISTRATION NO." 
                            name="cda_registration" 
                            value="{{ old('cda_registration') }}" 
                        />
                        <x-form-input 
                            label="DATE REGISTERED (CDA REGISTRATION)" 
                            name="date_registered" 
                            value="{{ old('date_registered') }}" 
                            type="date" 
                        />
                    </div>
                </div>
            </div>

            {{-- Membership Information --}}
            <div class="col-span-2">
                <h3 class="text-lg font-semibold mb-4">Membership Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form-input 
                        label="COMMON BOND OF MEMBERSHIP" 
                        name="common_bond" 
                        value="{{ old('common_bond') }}" 
                    />
                    <x-form-input 
                        label="MEMBERSHIP FEE PER BY LAWS" 
                        name="membership_fee" 
                        value="{{ old('membership_fee') }}" 
                        type="number" 
                    />
                </div>
            </div>

            {{-- Government Registration Information --}}
            <div class="col-span-2">
                <h3 class="text-lg font-semibold mb-4">Government Registration Details</h3>
                <div class="grid grid-cols-1 gap-4">
                    <div class="grid grid-cols-2 gap-4">
                        <x-form-input 
                            label="SSS EMPLOYER REGISTRATION NO." 
                            name="sss_registration" 
                            value="{{ old('sss_registration') }}" 
                        />
                        <x-form-input 
                            label="NO. OF SSS ENROLLED EMPLOYEES" 
                            name="sss_employees" 
                            value="{{ old('sss_employees') }}" 
                            type="number" 
                        />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-form-input 
                            label="PAGIBIG EMPLOYER REGISTRATION NO." 
                            name="pagibig_registration" 
                            value="{{ old('pagibig_registration') }}" 
                        />
                        <x-form-input 
                            label="NO. OF PAGIBIG ENROLLED EMPLOYEES" 
                            name="pagibig_employees" 
                            value="{{ old('pagibig_employees') }}" 
                            type="number" 
                        />
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <x-form-input 
                            label="PHILHEALTH EMPLOYER REGISTRATION NO." 
                            name="philhealth_registration" 
                            value="{{ old('philhealth_registration') }}" 
                        />
                        <x-form-input 
                            label="NO. OF PHILHEALTH ENROLLED EMPLOYEES" 
                            name="philhealth_employees" 
                            value="{{ old('philhealth_employees') }}" 
                            type="number" 
                        />
                    </div>
                </div>
            </div>

            {{-- Tax Information --}}
            <div class="col-span-2">
                <h3 class="text-lg font-semibold mb-4">Tax Information</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-form-input 
                        label="BIR TIN NUMBER" 
                        name="bir_tin" 
                        value="{{ old('bir_tin') }}" 
                    />
                    <div class="grid grid-cols-2 gap-4">
                        <x-form-input 
                            label="BIR TAX EXEMPTION NO." 
                            name="bir_tax_exemption" 
                            value="{{ old('bir_tax_exemption') }}" 
                        />
                        <x-form-input 
                            label="VALIDITY" 
                            name="tax_exemption_validity" 
                            value="{{ old('tax_exemption_validity') }}" 
                            type="date" 
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-between items-center">
        <x-previous-button href="#" label="Go Back" />
        <x-next-button href="{{ route('part2-membership') }}" label="Continue" />
    </div>      
</div>

@endsection