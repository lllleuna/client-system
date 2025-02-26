@extends('layouts.layout')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    {{-- Header Section --}}
    <div class="mb-8 bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">TC Related Concerns Coordination</h1>
        <div class="prose max-w-none text-gray-600">
            <p class="mb-4">
                Submit your Transportation Cooperative concerns for coordination with Government Organizations (GOs), 
                Non-Government Organizations (NGOs), and National Government Agencies (NGAs).
            </p>
            <div class="bg-blue-50 border-l-4 border-blue-500 p-4 my-4">
                <p class="font-medium">Important Notice:</p>
                <p class="text-sm mt-2">
                    This service facilitates assistance requests through OTC as authorized by Executive Order No. 898. 
                    We can coordinate with various government and non-government agencies to address your concerns 
                    through referral, coordination, or linkages for further assistance, guidance, and action.
                </p>
            </div>
        </div>
    </div>

    {{-- Concern Submission Form --}}
    <form action="#" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- Concern Details Section --}}
        <div class="bg-white rounded-lg shadow-md p-6">
            <h3 class="text-lg font-medium text-gray-700 mb-4">Concern Details</h3>
            
            {{-- Concern Type --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Type of Concern
                    <span class="text-red-500">*</span>
                </label>
                <select name="concern_type" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="">Select concern type</option>
                    <option value="technical">Technical Assistance</option>
                    <option value="operational">Operational Issues</option>
                    <option value="regulatory">Regulatory Compliance</option>
                    <option value="financial">Financial Matters</option>
                    <option value="other">Other Concerns</option>
                </select>
                @error('concern_type')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Concern Description --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Detailed Description of Concern
                    <span class="text-red-500">*</span>
                </label>
                <textarea 
                    name="concern_description" 
                    rows="4" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="Please provide a detailed description of your concern..."
                    required
                ></textarea>
                @error('concern_description')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Preferred Agency (Optional) --}}
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Preferred Agency for Coordination (Optional)
                </label>
                <input 
                    type="text" 
                    name="preferred_agency" 
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    placeholder="If you have a specific agency in mind"
                >
            </div>
        </div>

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
                                <p class="text-sm text-yellow-700">Document Requirements:</p>
                                <ul class="mt-2 text-sm text-yellow-700 list-disc pl-5">
                                    <li>All documents must be clear and legible</li>
                                    <li>Accept PDF format only</li>
                                    <li>Maximum file size: 5MB per document</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Letter Upload --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        1. Signed Letter from TC Chairperson
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg @error('chairperson_letter') border-red-300 @enderror">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="chairperson_letter" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500">
                                    <span>Upload a file</span>
                                    <input id="chairperson_letter" name="chairperson_letter" type="file" class="sr-only" required accept=".pdf">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">PDF up to 5MB</p>
                        </div>
                    </div>
                    @error('chairperson_letter')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Supporting Documents --}}
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        2. Supporting Documents
                        <span class="text-red-500">*</span>
                    </label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg @error('supporting_documents') border-red-300 @enderror">
                        <div class="space-y-1 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <div class="flex text-sm text-gray-600">
                                <label for="supporting_documents" class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500">
                                    <span>Upload files</span>
                                    <input id="supporting_documents" name="supporting_documents[]" type="file" class="sr-only" multiple required accept=".pdf">
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs text-gray-500">Multiple PDFs up to 5MB each</p>
                        </div>
                    </div>
                    @error('supporting_documents')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex items-center justify-end space-x-4">
            <button type="submit" class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                Submit Concern
            </button>
        </div>
    </form>
</div>

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
        }
    }

    // Setup file inputs
    setupFileInput('chairperson_letter');
    setupFileInput('supporting_documents');
});
</script>
@endsection