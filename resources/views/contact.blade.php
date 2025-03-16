@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
    <div class="max-w-2xl mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Contact Us</h1>
        <p class="text-gray-600 mb-6">Feel free to reach out to us for any inquiries.</p>

        <form action="{{ route('contact.store') }}" method="POST" class="mt-4">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" id="name" name="name" class="w-full p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Your name">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" class="w-full p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Your email address">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700">Message</label>
                <textarea id="message" name="message" class="w-full p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Your message"></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">Send</button>
        </form>

        <!-- Contact Information Section -->
        <div class="mt-10 bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Office Information</h2>
            <p class="text-gray-600 mb-2"><strong>Address:</strong> 5th Floor Ben-Lor Bldg., Brgy. Paligsahan, 1184 Quezon Avenue, Quezon City 1103</p>
            <p class="text-gray-600 mb-2"><strong>Email:</strong> <a href="mailto:official@otc.gov.ph" class="text-blue-600">official@otc.gov.ph</a></p>
            <p class="text-gray-600 mb-2"><strong>Cellphone:</strong> 09989461736 / 09772111310</p>
            <p class="text-gray-600 mb-2"><strong>Telephone:</strong> (02) 8332-9315</p>
            <p class="text-gray-600 mb-2"><strong>Facebook:</strong> <a href="https://www.facebook.com/DOTR.OTC" class="text-blue-600" target="_blank">DOTR.OTC</a></p>
        </div>
    </div>
@endsection
