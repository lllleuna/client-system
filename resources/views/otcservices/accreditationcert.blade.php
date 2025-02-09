@extends('layouts.layout')

@section('content')
<div class="max-w-4xl mx-auto p-6">

    {{-- Main Container --}}
    <div class="min-h-screen p-6 lg:p-8">
        {{-- Header Section --}}
        <div class="max-w-4xl mx-auto mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Cooperative Accreditation Status</h1>
            <p class="text-gray-600">
                View and download your cooperative's accreditation certificate, officially recognized by the Office of Transportation Cooperatives through its OTC Board.
            </p>
        </div>

        {{-- Certificate Card --}}
        <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            {{-- 
                Backend Note: 
                - Create a CertificateController to handle file retrieval and download
                - Store certificates in storage/app/public/certificates
                - Use symbolic link for public access
                - Add middleware to check user's cooperative association
            --}}
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Accreditation Certificate</h2>
                        <p class="text-sm text-gray-500">Last Updated: {{ date('F d, Y') }}</p>
                    </div>
                    <div class="flex space-x-3">
                        {{-- 
                            Backend Note:
                            - Replace dummy route with actual download endpoint
                            - Implement file download security checks
                            - Add proper mime type detection
                        --}}
                        <a 
                            href="#" 
                            class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                            </svg>
                            Download
                        </a>
                    </div>
                </div>

                {{-- Certificate Preview --}}
                <div class="border rounded-lg p-4 mb-6">
                    {{-- 
                        Backend Note:
                        - Replace with actual certificate retrieval logic
                        - Add proper error handling for missing files
                        - Consider implementing caching for better performance
                    --}}
                    <div class="aspect-[8.5/11] bg-gray-50 rounded-lg overflow-hidden">
                        {{-- Placeholder certificate preview --}}
                        <iframe 
                            src="{{ asset('storage/dummy-certificate.pdf') }}" 
                            class="w-full h-full"
                            {{-- Backend: Replace with actual certificate URL --}}
                        >
                        </iframe>
                    </div>
                </div>

                {{-- Certificate Details --}}
                <div class="border-t pt-4">
                    <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                        {{-- 
                            Backend Note:
                            - Replace these with actual data from your certificate model
                            - Consider adding validation dates
                            - Add cooperative details
                        --}}
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Certificate Number</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $certificateNumber ?? 'OTC-2024-001' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Issue Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $issueDate ?? 'January 15, 2024' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Valid Until</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $validUntil ?? 'January 15, 2025' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                    {{ $status ?? 'Active' }}
                                </span>
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    {{-- 
        Backend Implementation Notes:
        
        1. Routes (routes/web.php): DONE
        Route::get('/accreditation', [CertificateController::class, 'show'])->name('certificate.show');
        Route::get('/accreditation/download', [CertificateController::class, 'download'])->name('certificate.download');
        
        2. Model (app/Models/Certificate.php):
        - Create Certificate model with necessary fields
        - Add relationships to Cooperative model
        
        3. Controller (app/Http/Controllers/CertificateController.php):
        - Implement show() method for displaying certificate
        - Implement download() method with proper security checks
        - Add error handling for missing/invalid certificates
        
        4. Storage:
        - Run: php artisan storage:link
        - Store certificates in: storage/app/public/certificates
        - Use naming convention: cooperative_id_certificate_year.pdf
        
        5. Security:
        - Add middleware to verify user's cooperative association
        - Implement file access permissions
        - Add audit logging for downloads
    --}}
</div>
@endsection