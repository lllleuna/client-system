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
        <div class="flex flex-col md:flex-row gap-6">
            {{-- Year Selection Sidebar --}}
            <div class="w-full md:w-64 bg-white rounded-lg shadow-md p-4">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Select Year</h2>
                <div class="space-y-2">
                    {{-- 
                        BACKEND TODO:
                        1. Replace this static range with data from your years array
                        2. Add route handling for year selection
                        3. Implement active state logic using request()->year
                    --}}
                    @php $sampleYears = [2024, 2023, 2022, 2021, 2020]; @endphp
                    @foreach($sampleYears as $year)
                        <a 
                            href="#" {{-- BACKEND TODO: Replace with {{ route('cgs.history', ['year' => $year]) }} --}}
                            class="block w-full px-4 py-2 text-left rounded-md {{ $year === 2024 ? 'bg-blue-50 text-blue-700' : 'text-gray-700 hover:bg-gray-50' }}"
                        >
                            {{ $year }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Certificate Display Area --}}
            <div class="flex-1">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-900">CGS for 2024</h2>
                                <p class="text-sm text-gray-500">Issued by the Office of Transportation Cooperatives</p>
                            </div>
                            <div class="flex space-x-3">
                                {{-- BACKEND TODO: Replace href with proper download route --}}
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
                            <div class="aspect-[8.5/11] bg-gray-50 rounded-lg overflow-hidden">
                                {{-- BACKEND TODO: Replace with actual PDF viewer/iframe source --}}
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <div class="text-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <p>PDF Preview</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Certificate Details --}}
                        <div class="border-t pt-4">
                            <dl class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                                {{-- BACKEND TODO: Replace placeholder values with actual certificate data --}}
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Certificate Number</dt>
                                    <dd class="mt-1 text-sm text-gray-900">CGS-2024-001</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Issue Date</dt>
                                    <dd class="mt-1 text-sm text-gray-900">January 15, 2024</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Valid Until</dt>
                                    <dd class="mt-1 text-sm text-gray-900">December 31, 2024</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Status</dt>
                                    <dd class="mt-1">
                                        {{-- BACKEND TODO: Add logic to change color based on status --}}
                                        <span class="px-2 py-1 text-xs font-medium text-green-700 bg-green-100 rounded-full">
                                            Active
                                        </span>
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection