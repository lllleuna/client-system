@extends('layouts.layout')

@section('content')
<div class="max-w-4xl mx-auto p-6">
    {{-- Progress Indicator --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <span class="h-8 w-8 rounded-full bg-blue-600 text-white flex items-center justify-center">1</span>
                <div class="ml-4">
                    <p class="text-sm font-medium text-blue-600">Step 1</p>
                    <p class="text-sm text-gray-500">Review Requirements</p>
                </div>
            </div>
            <div class="flex-1 h-0.5 mx-4 bg-gray-200"></div>
            <div class="flex items-center">
                <span class="h-8 w-8 rounded-full bg-gray-200 text-gray-600 flex items-center justify-center">2</span>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Step 2</p>
                    <p class="text-sm text-gray-500">Document Upload</p>
                </div>
            </div>
        </div>
    </div>

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
    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8">
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
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
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

                {{-- OTC Annual Report Form Notice --}}
                <div class="bg-green-50 border-l-4 border-green-400 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                <strong>Download Required Template:</strong>
                            </p>
                            <p class="text-sm text-green-700 mt-1">
                                The OTC Annual Report Form template can be downloaded from:
                                <a href="https://otc.gov.ph/wp-content/uploads/2024/06/2024-OTC-Annual-Report-Form-FINAL-REVISED-06-20-2024.xlsx" 
                                   class="underline hover:text-green-900" 
                                   target="_blank">
                                    Download Template
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    {{-- Letter Request Upload --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            1. Letter Request signed by the Cooperative's Chairperson
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg @error('letter_request') border-red-300 @enderror">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="letter_request" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500">
                                        <span>Upload a file</span>
                                        <input id="letter_request" name="letter_request" type="file" class="sr-only" required accept=".pdf">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PDF up to 5MB</p>
                            </div>
                        </div>
                        @error('letter_request')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Certificate of Compliance Upload --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            2. Latest Certificate of Compliance (COC)
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg @error('coc') border-red-300 @enderror">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="coc" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500">
                                        <span>Upload a file</span>
                                        <input id="coc" name="coc" type="file" class="sr-only" required accept=".pdf">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PDF up to 5MB</p>
                            </div>
                        </div>
                        @error('coc')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- OTC Annual Report Form Upload --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            3. Accomplished OTC Annual Report Form
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg @error('annual_report') border-red-300 @enderror">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="annual_report" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500">
                                        <span>Upload a file</span>
                                        <input id="annual_report" name="annual_report" type="file" class="sr-only" required accept=".pdf">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PDF up to 5MB</p>
                            </div>
                        </div>
                        @error('annual_report')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex items-center justify-end space-x-4">
            <button type="button" class="py-2 px-4 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50">
                Save Draft
            </button>
            <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Submit Application
            </button>
        </div>
    </form>
</div>
@endsection

{{-- JavaScript for file upload preview --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Function to setup file input handling
    function setupFileInput(inputId) {
        const fileInput = document.getElementById(inputId);
        const dropZone = fileInput.closest('div.border-dashed');
        
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults (e) {
            e.preventDefault();
            e.stopPropagation();
        }

        ['dragenter', 'dragover'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.add('border-blue-300', 'bg-blue-50');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropZone.addEventListener(eventName, () => {
                dropZone.classList.remove('border-blue-300', 'bg-blue-50');
            }, false);
        });

        dropZone.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            
            if (files && files[0]) {
                // Add visual feedback
                const fileName = files[0].name;
                const file