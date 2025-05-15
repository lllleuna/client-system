@extends('layouts.layout')

@section('content')
    <div class="max-w-4xl mx-auto p-6">

        {{-- Main Container --}}
        <div class="min-h-screen p-6 lg:p-8">
            
            {{-- Header Section --}}
            <div class="max-w-4xl mx-auto mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Cooperative Accreditation Status</h1>
                <p class="text-gray-600">
                    View and download your cooperative's accreditation certificate, officially recognized by the Office of
                    Transportation Cooperatives through its OTC Board.
                </p>
            </div>

            {{-- Main Content --}}
            <div class="flex flex-col gap-6">
                @if (!$generalInfo)
                    <div class="text-center bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-900">No Certificate History</h2>
                        <p class="text-gray-600 mt-2">
                            There are no Accreditation Certificate records available for your cooperative.
                        </p>
                    </div>
                @else
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-900">Accreditation Certificate</h2>
                                    <p class="text-sm text-gray-500">
                                        Issued by the Office of Transportation Cooperatives
                                    </p>
                                </div>

                                @if ($generalInfo->accreditation_certificate_filename)
                                    <a href="{{ asset('shared/certificates/' . $generalInfo->accreditation_certificate_filename) }}"
                                        target="_blank"
                                        class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                        Download
                                    </a>
                                @endif
                            </div>

                            {{-- Certificate Details --}}
                            <div class="border-t pt-4">
                                <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Date Accredited</dt>
                                        <dd class="mt-1 text-sm text-gray-900 flex items-center">
                                            {{ \Carbon\Carbon::parse($generalInfo->accreditation_date)->format('F d, Y') }}
                                        </dd>
                                    </div>
                                </dl>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
