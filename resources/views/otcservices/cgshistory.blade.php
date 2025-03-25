@extends('layouts.layout')

@section('content')
    <div class="max-w-6xl mx-auto p-6">
        <div class="min-h-screen p-6 lg:p-8">
            {{-- Header Section --}}
            <div class="max-w-4xl mx-auto mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Certificate of Good Standing History</h1>
                <p class="text-gray-600">
                    View and track your cooperative's historical CGS certificates and compliance records over the years.
                </p>
            </div>

            {{-- Main Content Grid --}}
            <div class="flex flex-col gap-6">
                @if ($generalInfos->isEmpty())
                    <div class="text-center bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-900">No Certificate History</h2>
                        <p class="text-gray-600 mt-2">There are no Certificate of Good Standing records available for your
                            cooperative.</p>
                    </div>
                @else
                    @foreach ($generalInfos as $generalInfo)
                        <div class="flex-1">
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-6">
                                        <div>
                                            <h2 class="text-xl font-semibold text-gray-900">
                                                CGS for {{ \Carbon\Carbon::parse($generalInfo->created_at)->format('Y') }}
                                            </h2>
                                            <p class="text-sm text-gray-500">Issued by the Office of Transportation
                                                Cooperatives</p>
                                        </div>

                                        @if ($generalInfo->cgs_filename)
                                            <a href="{{ asset('shared/certificates/' . $generalInfo->cgs_filename) }}"
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

                                        @if ($generalInfo->certificate_file)
                                            <a href="{{ asset('shared/certificates/' . $generalInfo->certificate_file) }}"
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
                                                <dt class="text-sm font-medium text-gray-500">Issue Date</dt>
                                                <dd class="mt-1 text-sm text-gray-900">
                                                    {{ \Carbon\Carbon::parse($generalInfo->created_at)->format('F d, Y') }}
                                                </dd>
                                            </div>
                                            <div>
                                                <dt class="text-sm font-medium text-gray-500">Valid Until</dt>
                                                <dd class="mt-1 text-sm text-gray-900 flex items-center">
                                                    {{ \Carbon\Carbon::parse($generalInfo->validity_date)->format('F d, Y') }}

                                                    @if (\Carbon\Carbon::parse($generalInfo->validity_date)->isPast())
                                                        <span
                                                            class="ml-2 px-2 py-1 text-xs font-semibold text-white bg-red-500 rounded">Expired</span>
                                                    @else
                                                        <span
                                                            class="ml-2 px-2 py-1 text-xs font-semibold text-white bg-green-500 rounded">Active</span>
                                                    @endif
                                                </dd>
                                            </div>
                                        </dl>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>


        </div>
    </div>
@endsection
