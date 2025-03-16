<x-accredit-steps>
    <div class="my-6 mx-auto w-full sm:w-1/2 flex flex-col p-5 rounded-lg shadow-md bg-white">
        <h2>Information</h2> <br>
        <p>Transportation Cooperative Name: {{ session('form_data.tc_name', 'N/A') }}</p>
        <p>CDA Registration No: {{ $formData['cda_reg_no'] }}</p>
        <p>CDA Registration Date: {{ $formData['cda_reg_date'] }}</p>
        <p>Address: {{ $formData['address'] }}</p>
        <p>Barangay: {{ $formData['barangay'] }}</p>
        <p>City/Municipality: {{ $formData['city_municipality'] }}</p>
        <p>Province: {{ $formData['province'] }}</p>
        <p>Area: {{ $formData['area'] }}</p>
    
        {{-- ... display other text data --}}
        @if(isset($formData['file_upload']))
            <p>Signed Letter Request: <a href="{{ Storage::url($formData['file_upload']) }}" class="text-blue-600" target="_blank">View File</a></p>
        @endif
    
        
        {{-- <p>Text Field 2: {{ $formData['message'] }}</p> --}}
        <div class="mt-10 flex justify-between ">
            <a href="/accreditation/form2" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-300 focus:outline-none">
                Previous
            </a>
            <form action="{{ route('submitForm') }}" method="POST">
                @csrf
                <button type="submit" class="bg-blue-900 text-white px-4 py-2 rounded-lg hover:bg-blue-800 focus:outline-none">Submit</button>
            </form>
        </div>
    </div>
</x-accredit-steps>