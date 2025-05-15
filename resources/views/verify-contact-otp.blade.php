@extends('layouts.layout')

@section('content')
    <div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow">
        <h2 class="text-xl font-semibold mb-4 text-center">Verify Contact Number</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-600">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('verify.contact.otp.submit') }}">
            @csrf
            <div class="mb-4">
                <label for="otp" class="block text-sm font-medium text-gray-700">Enter OTP</label>
                <input type="text" name="otp" id="otp" maxlength="6"
                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
            </div>

            <div class="flex justify-between gap-4">
                <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md">Verify</button>
                <a href="{{ route('generalinfo') }}"
                    class="w-full text-center bg-gray-300 text-gray-800 py-2 rounded-md hover:bg-gray-400">Cancel</a>
            </div>
        </form>

        <div class="mt-6 text-center">
            <form action="{{ route('resend.contact.otp') }}" method="POST">
                @csrf
                <button type="submit" class="text-blue-600 hover:underline">
                    Didn’t receive the code? <strong>Resend OTP</strong>
                </button>
            </form>
        </div>
        
    </div>
@endsection
