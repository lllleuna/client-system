@extends('layouts.app')
@section('title', 'Email Verification')
@section('content')
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8">
                <div class="w-full md:w-1/2 text-center md:text-left">
                    <!-- Status Badge -->
                    <div class="inline-flex items-center bg-yellow-100 text-yellow-800 px-4 py-2 rounded-full mb-6">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <span class="font-semibold">Email Verification Required</span>
                    </div>

                    <h2 class="text-4xl font-bold uppercase text-blue-900 mb-4">Verify Your Email</h2>
                    <p class="uppercase text-2xl mb-8 italic text-gray-700">"Innovation towards modernization"</p>

                    @if (session('message'))
                        <div class="mb-6 p-4 rounded-md bg-green-50 border border-green-200 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-green-600">{{ session('message') }}</p>
                        </div>
                    @endif

                    <!-- Steps Container -->
                    <div class="bg-white rounded-lg p-6 shadow-sm border border-gray-100 mb-8">
                        <div class="text-gray-600">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-900 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">1</div>
                                <p>Check your email inbox for the verification link</p>
                            </div>
                            <div class="flex items-center">
                                <div class="bg-blue-900 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">2</div>
                                <p>Click the verification link to activate your account</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-lg p-6 mb-8 border border-gray-200">
                        <h3 class="font-semibold text-gray-800 mb-2">Haven't received the verification email?</h3>
                        <p class="text-gray-600 mb-4">No problem! Click below to send it again.</p>
                        <form action="{{ route('verification.send') }}" method="POST">
                            @csrf
                            <button type="submit" class="text-white bg-yellow-500 hover:bg-yellow-400 focus:ring-4 focus:outline-none focus:ring-yellow-200 font-medium rounded-lg text-md px-6 py-3 uppercase w-full md:w-auto flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                                </svg>
                                Resend Verification Email
                            </button>
                        </form>
                    </div>

                    <div class="flex items-center text-sm text-gray-500 bg-blue-50 p-4 rounded-lg">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <p>Can't find the email? Remember to check your spam or junk folder.</p>
                    </div>
                </div>

                <div class="w-full md:w-1/2">
                    <img src="{{ asset('images/otc-logo.png') }}" alt="OTC Logo" class="mx-auto">
                </div>
            </div>
        </div>
    </div>
@endsection