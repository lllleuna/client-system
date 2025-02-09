@extends('layouts.layout')

@section('content')
<div class="max-w-6xl mx-auto p-6">
    {{-- Header Section --}}
    <div class="mb-8 bg-white rounded-lg shadow-md p-6">
        <h1 class="text-2xl font-bold text-gray-800 mb-4">My Cooperative Dashboard</h1>
        <div class="prose max-w-none text-gray-600">
            <p class="mb-4">
                Access and manage your cooperative's essential documents and information. Keep track of your certificates,
                reports, and training records all in one place.
            </p>
        </div>
    </div>

    {{-- Main Grid Section --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        {{-- Accreditation Certificate --}}
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-6 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 text-center mb-3">Accreditation Certificate</h2>
                <p class="text-sm text-gray-600 text-center mb-4">View and download your cooperative's current accreditation.</p>
                <div class="flex justify-center">
                    <a href="{{ route('accreditationcert') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-blue-600 hover:text-blue-800">
                        View Certificate
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Cooperative Information --}}
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 bg-green-100 rounded-full mb-6 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 text-center mb-3">Cooperative Information</h2>
                <p class="text-sm text-gray-600 text-center mb-4">Manage your cooperative's profile, members, and essential details.</p>
                <div class="flex justify-center">
                    <a href="{{ route('membersMasterlist') }}" class="inline-flex items-center px-4 py-2 text-sm font-medium text-green-600 hover:text-green-800">
                        View Details
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Certificate of Good Standing (CGS) History --}}
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 bg-purple-100 rounded-full mb-6 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 text-center mb-3">Certificate of Good Standing (CGS) History</h2>
                <p class="text-sm text-gray-600 text-center mb-4">View your cooperative's previous CGS certificates and track your compliance history.</p>
                <div class="flex justify-center">
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-purple-600 hover:text-purple-800">
                        View History
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        {{-- Training History --}}
        <div class="bg-white rounded-lg shadow-md border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300">
            <div class="p-6">
                <div class="flex items-center justify-center w-16 h-16 bg-red-100 rounded-full mb-6 mx-auto">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                </div>
                <h2 class="text-lg font-semibold text-gray-900 text-center mb-3">Training History</h2>
                <p class="text-sm text-gray-600 text-center mb-4">Access your cooperative's training records and certificates.</p>
                <div class="flex justify-center">
                    <a href="#" class="inline-flex items-center px-4 py-2 text-sm font-medium text-red-600 hover:text-red-800">
                        View History
                        <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
