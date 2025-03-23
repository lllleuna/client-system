@extends('layouts.app')

@section('content')

    <div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
        <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold text-center text-gray-900 mb-4">Forgot Password</h2>
            <p class="text-center text-gray-600 mb-6">Enter your email to receive a password reset link.</p>

            @if (session('status'))
                <div class="mb-4 text-green-500 text-center text-sm">
                    {{ session('status') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="mb-4 text-red-500 text-center text-sm">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif


            <form id="forgot-password-form" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" name="email" id="email"
                        class="w-full px-4 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        required placeholder="Enter your email">
                    <p id="email-error" class="hidden text-red-500 text-xs mt-1"></p>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-200">
                    Send Reset Link
                </button>
            </form>

            <div class="text-center mt-4">
                <a href="{{ route('login') }}" class="text-blue-700 text-sm hover:underline">Back to Login</a>
            </div>
        </div>
    </div>
@endsection
