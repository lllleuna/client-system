<x-accredit-steps>
    <form action="/accreditation/create" method="POST" id="form" name="form" enctype="multipart/form-data">
        @csrf
        <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-white">
            
            <!-- Container for Steps and Image -->
            <div class="flex flex-col justify-center items-center my-6">
                <!-- Steps Text on the Left -->
                <div class="text-left mb-4">
                    <p class="text-xl">Steps in Compiling and Uploading Your Requirements</p>
                </div>

                <!-- Image Centered -->
                <div class="flex justify-center">
                    <img src="{{ asset('images/tutorials.gif') }}" alt="Tutorial Image" class="w-64 h-64 object-contain rounded-lg border">
                </div>
            </div>
        </div>

        <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-white">
            
            <!-- Second Container for Steps and Image -->
            <div class="flex flex-col justify-center items-center my-6">
                <!-- Steps Text on the Left -->
                <div class="text-left mb-4">
                    <p class="text-xl">Sample of Compiled Requirements in one (1) PDF File</p>
                </div>

                <!-- Image Centered -->
                <div class="flex justify-center">
                    <img src="{{ asset('images/tutorials2.jpg') }}" alt="Tutorial Image" class="w-64 h-64 object-contain rounded-lg border">
                </div>
            </div>

        </div>

         <!-- File Upload (for tutorial gif or picture) -->
        <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-white">
            <p><strong>Upload Necessary File</strong></p>
            <div class="w-full mb-4">
                <label for="file_upload" class="block text-gray-700">Choose a file</label>
                <input type="file" id="file_upload" name="file_upload" class="w-full p-2 border rounded-lg" accept="image/*" required>
            </div>
            <x-form-error name="file_upload" />
        </div>

        {{-- Comments --}}
        <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-white">
        <!-- Transport Cooperative Name -->
        <p><strong>Comments:</strong></p>
        <x-form-label for="tc_name">Please indicate any comments or clarifications you may have 
            regarding your application and/or uploaded requirements.</x-form-label>
            <div class="mb-4">
                <label for="message" class="block text-gray-700">Message</label>
                <textarea id="message" name="message" class="w-full p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Your message"></textarea>
            </div>
        </div>


        <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-orange-100">
            <div>
            <p class="text-xl"><strong> OTC Operational Department</strong></p>
            </div>
        </div>        

        <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-white">
            <p><strong>DISCLAIMER FOR UMAK OFFICES (PIP/ PIC)</strong></p>
            <x-form-label for="tc_name">The Center for Admission and Scholarship of the University 
                of Makati (UMak) recognizes and protects your rights as data subject by applying 
                appropriate security measures in compliance with existing laws on data privacy, 
                records management and cyber security. We only require the minimum amount of 
                personal information or security information which are necessary for the processing 
                of your transaction with us. By accessing or visiting our form, your data will be 
                collected and handled by our designated personnel and will not be shared with third 
                parties, with exceptions provided by law.</x-form-label>
        </div>


        <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-white">
            <!-- Consent Section -->
            <p><strong>Please check the box below, so we could process your transaction:</p></strong>
            
            <div class="flex items-center">
                <!-- Consent Checkbox -->
                <input type="checkbox" id="consent_checkbox" name="consent" class="mr-2">
                <label for="consent_checkbox" class="text-gray-500">
                    I am giving my consent for the Office of the Transportation Cooperatives to collect 
                    and process my data.
                </label>
            </div>
        </div>
        
        <div class="my-6 m-auto w-3/3 sm:w-1/2 items-center p-5 rounded-lg shadow-md bg-white">
            <!-- Contact Information Section -->
            <p class="text-xl"><strong>Contact us at:</strong></p>
        
            <div class="space-y-2">
                <p>General information: <a href="mailto: info@umak.edu.ph" class="text-blue-500">info@umak.edu.ph</a></p>
                <p>Data Privacy Rights: <a href="mailto: dprms@umak.edu.ph" class="text-blue-500">dprms@umak.edu.ph</a></p>
                <p>Learning Hub: <a href="mailto: tbl.lms@umak.edu.ph" class="text-blue-500">tbl.lms@umak.edu.ph</a></p>
                <p>UMak email: <a href="mailto: itc_support@umak.edu.ph" class="text-blue-500">itc_support@umak.edu.ph</a></p>
                <p>For follow-ups on your transaction: <a href="mailto: cas.scholarshipapplication@umak.edu.ph" class="text-blue-500">cas.scholarshipapplication@umak.edu.ph</a></p>
            </div>

            <div class="flex justify-end">
                <x-form-submit-button>Submit</x-form-submit-button>
            </div>
        </div>
        
    </form>
</x-accredit-steps>
