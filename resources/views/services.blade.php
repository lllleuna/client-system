@extends('layouts.app')

@section('title', 'Our Services')

@section('content')
    <div class="max-w-4xl mx-auto mt-10">
        <h1 class="text-3xl font-bold text-center mb-6">Our Services</h1>
        <p class="text-gray-600 text-center mb-10">We provide essential services for transport cooperatives, ensuring smooth operations, accreditation, and compliance.</p>

        <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">For New Cooperatives</h2>
            <ul class="list-disc pl-5 text-gray-700">
                <li>Apply for accreditation</li>
                <li>Record applications and cooperative details</li>
                <li>Release Certificate of Accreditation and Certificate of Good Standing</li>
            </ul>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg shadow-md mb-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">For Existing Cooperatives</h2>
            <ul class="list-disc pl-5 text-gray-700">
                <li>Renew Certificate of Good Standing</li>
                <li>Submit requirements</li>
                <li>Review and approve applications</li>
                <li>Release Certificate of Good Standing</li>
            </ul>
        </div>

        <div class="bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">For Both New and Existing Cooperatives</h2>
            <ul class="list-disc pl-5 text-gray-700">
                <li>Request and conduct training (Face-to-Face or Online)</li>
            </ul>
        </div>
    </div>
@endsection
