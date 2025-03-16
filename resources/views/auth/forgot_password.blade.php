@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-xl font-bold text-center text-gray-900">Forgot Password</h2>
        <p class="text-center text-gray-600 mb-4">Enter your email to receive a password reset link.</p>

        {{-- Success or error message (to be handled by backend) --}}
        <div id="status-message" class="hidden mb-4 text-center text-sm"></div>

        <form id="forgot-password-form" action="#" method="POST">
            @csrf
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500"
                    required 
                    placeholder="Enter your email"
                >
                <p id="email-error" class="hidden text-red-500 text-xs mt-1"></p>
            </div>

            <button 
                type="submit" 
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200"
            >
                Send Reset Link
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('login') }}" class="text-blue-600 text-sm hover:underline">Back to Login</a>
        </div>
    </div>
</div>
@endsection
