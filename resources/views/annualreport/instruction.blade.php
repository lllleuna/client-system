@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-50 py-6">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8">
            <!-- Header Section -->
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">2024 – OTC Annual Report Form</h1>
                <div class="mt-4 flex justify-center items-center space-x-4">
                    <h2 class="text-xl font-semibold text-gray-800">ANNUAL REPORT</h2>
                    <div class="flex items-center">
                        <span class="text-gray-600">Period Covered:</span>
                        <span class="ml-2 font-semibold text-gray-800">CY 2023</span>
                    </div>
                </div>
            </div>

            <!-- Instructions Box -->
            <div class="bg-blue-50 border border-blue-100 rounded-lg p-6 mb-8">
                <h3 class="text-lg font-semibold text-blue-900 mb-4">INSTRUCTION:</h3>
                <div class="text-blue-800 space-y-4">
                    <p>
                        This report is one of the requirements for the issuance of Certificate of Good Standing (CGS) to Transport Service Cooperatives (TSCs) and so to avoid possible inconvenience on your part, it is strongly advised that you carefully fill-up and give appropriate answers or information to all entry items in the spaces provided for the purpose.
                    </p>
                    <p>
                        No blank or unanswered item/s shall be allowed hence incomplete, insufficient or not answered item/s in this report may cause the denial of receipt of the same and possible return of the document to you for completion and/or rectification.
                    </p>
                    <p>
                        Write "Not Applicable or N/A" to those requested information items that do not apply to you and "NONE" to that information you currently do not have or put "ON PROCESS" to that requested information that you are still processing.
                    </p>
                </div>
            </div>

            <!-- Report Sections Overview -->
            <div class="bg-gray-50 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">This Report is divided into seven (7) clustered parts:</h3>
                <ul class="list-disc list-inside space-y-2 text-gray-700 ml-4">
                    <li>Item I – Basic/Primary Information</li>
                    <li>Item II – Membership</li>
                    <li>Item III – Units and Franchise</li>
                    <li>Item IV – Operations</li>
                    <li>Item V – Financial & Business Aspect</li>
                    <li>Item VI – Capacity/Capability Building Program</li>
                    <li>Item VII – Other Related Information</li>
                </ul>
            </div>

            <!-- Navigation Buttons -->
            <div class="mt-8 flex justify-end space-x-4">
                <button type="button" 
                        class="px-6 py-2.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition-all duration-200">
                    Save Draft
                </button>
                <a href="{{ route('part1-basic') }}" 
                    class="px-6 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all duration-200">
                    Continue to Basic Information
                </a>

            </div>
        </div>
    </div>
</div>
@endsection