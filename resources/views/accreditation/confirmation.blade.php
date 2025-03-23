<x-accredit-steps>
    <div class="my-10 mx-auto w-full max-w-2xl flex flex-col p-8 rounded-2xl shadow-lg bg-white border border-gray-200">
        <h2 class="text-2xl font-bold text-center text-gray-800 mb-4">Confirmation</h2>
        <p class="text-center text-gray-600 mb-8">Please review the information below before submitting.</p>

        <div class="space-y-4 text-sm text-gray-700">
            <div>
                <p class="font-medium text-gray-800">Transportation Cooperative Name:</p>
                <p>{{ session('form_data.tc_name', 'N/A') }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-800">CDA Registration No:</p>
                <p>{{ $formData['cda_reg_no'] }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-800">CDA Registration Date:</p>
                <p>{{ $formData['cda_reg_date'] }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-800">Address:</p>
                <p>{{ $formData['address'] }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-800">Barangay:</p>
                <p>{{ $barangayName }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-800">City/Municipality:</p>
                <p>{{ $cityName }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-800">Province:</p>
                <p>{{ $provinceName }}</p>
            </div>
            <div>
                <p class="font-medium text-gray-800">Area:</p>
                <p>{{ $formData['area'] }}</p>
            </div>

            @if(isset($formData['file_upload']))
            <div>
                <p class="font-medium text-gray-800">Signed Letter Request:</p>
                <a href="{{ asset('shared/uploads/' . basename($formData['file_upload'])) }}" target="_blank" class="text-blue-600 hover:underline">View File</a>
            </div>
            @endif
        </div>

        <div
            class="mt-10 flex flex-col md:flex-row justify-between items-center space-y-6 md:space-y-0 md:space-x-4 w-full">

            <!-- Submit Form -->
            <form action="{{ route('submitForm') }}" method="POST" class="flex flex-col items-center w-full">
                @csrf

                <!-- Captcha Section -->
                <div class="mt-0 mb-4 flex justify-start w-full flex-col">
                    {!! htmlFormSnippet() !!}

                    <!-- Captcha Error -->
                    @if ($errors->has('g-recaptcha-response'))
                        <span class="text-red-500 text-sm mt-2">{{ $errors->first('g-recaptcha-response') }}</span>
                    @endif
                </div>

                <div class="flex w-full justify-between">
                    <!-- Edit Button -->
                    <a href="{{ route('form2') }}"
                        class="bg-gray-100 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-200 transition shadow-md">
                        &#8592; Edit Information
                    </a>

                    <!-- Submit Button -->
                    <button type="submit"
                        class="bg-blue-900 text-white px-6 py-2 rounded-lg hover:bg-blue-800 transition shadow-md">
                        Confirm & Submit
                    </button>
                </div>

            </form>

            <!-- reCAPTCHA Script -->
            {!! htmlScriptTagJsApi() !!}

        </div>



    </div>
</x-accredit-steps>
