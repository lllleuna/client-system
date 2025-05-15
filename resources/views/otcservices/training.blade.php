@extends('layouts.layout')

@section('content')
    <div class="max-w-4xl mx-auto p-6">

        {{-- Header Section with Enhanced Information --}}
        <div class="mb-8 bg-white rounded-lg shadow-md p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">Transportation Cooperative Training Registration</h1>
            <div class="prose max-w-none text-gray-600">
                <p class="mb-4">
                    This comprehensive training program is designed to equip you with essential knowledge about
                    transportation cooperatives
                    and their unique operational characteristics compared to other transport organizations.
                </p>
                <div class="bg-blue-50 border-l-4 border-blue-500 p-4 my-4">
                    <p class="font-medium">Legal Requirement Notice:</p>
                    <p class="text-sm">
                        This training is mandatory for Transportation Cooperative registration with CDA, as stipulated in
                        Rule V,
                        Section 6, Item 5 of the Implementing Rules and Regulations (IRR) of Republic Act 9520.
                    </p>
                </div>
            </div>
        </div>

        {{-- Training Registration Form --}}
        <form action="{{ route('training.request.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- Training Mode Selection --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <label class="block text-lg font-medium text-gray-700 mb-4">Select Training Mode</label>
                <div class="grid md:grid-cols-2 gap-4">
                    {{-- Face to Face Option --}}
                    <label
                        class="relative border-2 rounded-lg p-4 cursor-pointer transition-all hover:border-blue-200 @error('training_type') border-red-300 @enderror">
                        <div class="flex items-center space-x-2">
                            <input type="radio" name="training_type" value="face-to-face" class="h-4 w-4 text-blue-600"
                                required>
                            <span class="font-medium">Face to Face Training</span>
                        </div>
                        <p class="mt-2 text-sm text-gray-500 pl-6">
                            Attend in-person training sessions at <br> <span class="font-semibold">Training Room 8th Floor
                                Columbia Towers</span>.
                        </p>
                        <a href="https://maps.app.goo.gl/nyhGcJoLtsnonWT37"
                            class="mt-2 text-sm text-blue-700 pl-6 underline">
                            H3V4+QFQ, Ortigas Ave, Mandaluyong, Metro Manila
                        </a>
                        <ul class="mt-3 text-sm text-gray-500 pl-6 list-disc space-y-1">
                            <li>Direct interaction with instructors.</li>
                            <li>Hands-on learning experience.</li>
                            <li>Ideal for Cooperatives around Metro Manila.</li>
                        </ul>
                    </label>

                    {{-- Online Platform Option --}}
                    <label
                        class="relative border-2 rounded-lg p-4 cursor-pointer transition-all hover:border-blue-200 @error('training_type') border-red-300 @enderror">
                        <div class="flex items-center space-x-2">
                            <input type="radio" name="training_type" value="online" class="h-4 w-4 text-blue-600"
                                required>
                            <span class="font-medium">Online Platform</span>
                        </div>
                        <p class="mt-2 text-sm text-gray-500 pl-6">
                            Participate in virtual training sessions from any location.
                        </p>
                        <ul class="mt-3 text-sm text-gray-500 pl-6 list-disc space-y-1">
                            <li>Saves on travel, venue, and accommodation.</li>
                            <li>Scalable for large groups.</li>
                            <li>Ideal for people with busy schedules or remote locations.</li>
                        </ul>
                    </label>
                    @error('training_type')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Document Upload Section --}}
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="space-y-6">
                    <div>
                        <h3 class="text-lg font-medium text-gray-700 mb-4">Required Document</h3>
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
                                        Please ensure that the uploaded document is:
                                    </p>
                                    <ul class="mt-2 text-sm text-yellow-700 list-disc pl-5">
                                        <li>Clear and legible</li>
                                        <li>In PDF format</li>
                                        <li>Less than 5MB in size</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-6">
                        {{-- Letter Request Upload --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Letter Request signed by the Cooperative's Chairperson
                                <span class="text-red-500">*</span>
                            </label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-dashed rounded-lg @error('letter_of_intent') border-red-300 @enderror">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="letter_of_intent"
                                            class="relative cursor-pointer rounded-md font-medium text-blue-600 hover:text-blue-500">
                                            <span>Upload a file</span>
                                            <input id="letter_of_intent" name="letter_of_intent" type="file"
                                                class="sr-only" required accept=".pdf" onchange="showFileName(event)">
                                        </label>
                                    </div>
                                    <p id="file-name" class="text-base text-gray-700 mt-5">PDF up to 5MB</p>
                                    <!-- File name display -->

                                </div>
                            </div>
                            @error('letter_of_intent')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            <div id="letter_of_intent_preview" class="mt-2 hidden">
                                <div class="flex items-center space-x-2">
                                    <svg class="h-5 w-5 text-green-500" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    <span class="text-sm text-gray-500">File selected</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    {!! htmlFormSnippet() !!}

                </div>
            </div>

            {{-- Submit Button --}}
            <div class="flex items-center justify-end space-x-4">
                <button type="submit"
                    class="py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Submit Request
                </button>
            </div>
        </form>

        {!! htmlScriptTagJsApi() !!}

    </div>

    {{-- JavaScript for file upload preview --}}
    <script>
        function showFileName(event) {
            const input = event.target;
            const fileName = input.files.length > 0 ? input.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const fileInput = document.getElementById('letter_of_intent');
            const preview = document.getElementById('letter_of_intent_preview');

            fileInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    preview.classList.remove('hidden');
                } else {
                    preview.classList.add('hidden');
                }
            });

            // Drag and drop functionality
            const dropZone = fileInput.closest('div');

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropZone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropZone.addEventListener(eventName, unhighlight, false);
            });

            function highlight(e) {
                dropZone.classList.add('border-blue-300', 'bg-blue-50');
            }

            function unhighlight(e) {
                dropZone.classList.remove('border-blue-300', 'bg-blue-50');
            }

            dropZone.addEventListener('drop', handleDrop, false);

            function handleDrop(e) {
                const dt = e.dataTransfer;
                const files = dt.files;
                fileInput.files = files;

                if (files && files[0]) {
                    preview.classList.remove('hidden');
                }
            }
        });
    </script>
@endsection
