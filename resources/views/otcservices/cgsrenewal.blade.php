@extends('layouts.layout')

@section('content')
    <div class="max-w-4xl mx-auto p-6">

        {{-- DISABLE! --}}
        {{-- <x-cgs-modals /> --}}

        {{-- Header Section with Enhanced Information --}}
        <div class="mb-8 bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Certificate of Good Standing (CGS) Application</h1>
            <div class="prose max-w-none text-gray-600">
                <p class="mb-4">
                    The Certificate of Good Standing (CGS) is a crucial document that enables cooperatives to exercise
                    their rights and privileges under Republic Act 9520 and Executive Order 898.
                </p>
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 my-4">
                    <p class="font-medium">Important Notice:</p>
                    <p class="text-sm">
                        Please ensure all submitted documents are complete and valid to avoid processing delays.
                        All certificates and forms must be current and properly authenticated.
                    </p>
                </div>
            </div>
        </div>

        {{-- CGS Application Form --}}
        <form action="{{ route('renewal.submit') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- Document Upload Section --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-4">Required Documents</h3>
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Document Requirements:
                                    </p>
                                    <ul class="mt-2 text-sm text-yellow-700 list-disc pl-5">
                                        <li>All documents must be clear and legible</li>
                                        <li>Accept PDF format only</li>
                                        <li>Maximum file size: 5MB per document</li>
                                        <li>Ensure all signatures are complete</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        {{-- Letter Request Upload --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                1. Letter Request signed by the Cooperative's Chairperson <br>
                                2. Latest Certificate of Compliance (COC)
                                <span class="text-red-500">*</span>
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg @error('letter_request') border-red-300 @enderror">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center items-center">
                                        <label for="letter_request"
                                            class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500">
                                            <span>Upload a file</span>
                                            <input id="letter_request" name="letter_request" type="file" class="sr-only"
                                                required accept=".pdf" onchange="showFileName(event)">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PDF up to 10MB</p>
                                    <p id="selected-file-name" class="text-sm text-gray-700 font-semibold mt-2 hidden"></p>
                                </div>
                            </div>
                            @error('letter_request')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Consent Section -->
                        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                            <h2 class="text-lg font-semibold text-gray-800 mb-4">Required Declarations <span
                                    class="text-red-600">*</span></h2>
                            <div class="flex items-start space-x-3">
                                <input type="checkbox" id="consent_checkbox" name="consent" required
                                    class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="consent_checkbox" class="text-sm text-gray-600">
                                    I am giving my consent for the Office of the Transportation Cooperatives to collect and
                                    process my data. <span class="text-red-600">*</span>
                                </label>
                            </div>
                            @error('consent')
                                <div class="ml-7 text-sm text-red-600">{{ $message }}</div>
                            @enderror


                            <div class="flex items-start space-x-3 mt-4">
                                <input type="checkbox" id="oath" name="oath" required
                                    class="mt-1 w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <label for="oath" class="text-sm text-gray-600">
                                    I hereby certify that all information I have provided prior to and during this
                                    application, as recorded on this website, is true, correct, and updated to the best of
                                    my knowledge. <span class="text-red-600">*</span>
                                </label>
                            </div>
                            @error('oath')
                                <div class="ml-7 text-sm text-red-600">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>
                    {!! htmlFormSnippet() !!}

                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-end space-x-4">
                <button type="button"
                    class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                    Save Draft
                </button>
                <button type="submit"
                    class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Submit Application
                </button>
            </div>
        </form>

        {!! htmlScriptTagJsApi() !!}

    </div>

    <script>
        function showFileName(event) {
            const fileName = event.target.files[0]?.name || '';
            const display = document.getElementById('selected-file-name');
            if (fileName) {
                display.textContent = "Selected file: " + fileName;
                display.classList.remove('hidden');
            } else {
                display.textContent = '';
                display.classList.add('hidden');
            }
        }
    </script>
@endsection

