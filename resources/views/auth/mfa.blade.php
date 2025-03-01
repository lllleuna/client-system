@include('prompt')

@extends('layouts.layout')

@section('content')
    <!-- MFA Setup Page using Laravel and Tailwind CSS -->

    <div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                    Set Up Multi-Factor Authentication
                </h2>
                <p class="mt-2 text-sm text-gray-600">
                    Protect your account with an additional layer of security
                </p>
            </div>

            <!-- Steps -->
            <div class="relative">
                <div class="absolute inset-0 flex items-center" aria-hidden="true">
                    <div class="w-full border-t border-gray-300"></div>
                </div>
                <div class="relative flex justify-between">
                    <div>
                        <span class="relative flex h-8 w-8 items-center justify-center rounded-full bg-indigo-600 text-white">
                            <span class="text-sm font-medium">1</span>
                        </span>
                        <span class="mt-2 block text-sm font-medium text-gray-900">SMS Verification</span>
                    </div>
                    <div>
                        <span class="relative flex h-8 w-8 items-center justify-center rounded-full bg-gray-200 text-gray-600">
                            <span class="text-sm font-medium">2</span>
                        </span>
                        <span class="mt-2 block text-sm font-medium text-gray-500">Authenticator App</span>
                    </div>
                    <div>
                        <span class="relative flex h-8 w-8 items-center justify-center rounded-full bg-gray-200 text-gray-600">
                            <span class="text-sm font-medium">3</span>
                        </span>
                        <span class="mt-2 block text-sm font-medium text-gray-500">Complete</span>
                    </div>
                </div>
            </div>

            <!-- Content Box -->
            <div class="mt-8 bg-white py-8 px-4 shadow sm:rounded-lg sm:px-10">
                <!-- Step 1: SMS Verification (active) -->
                <div class="step-content" id="step-sms">
                    <form action="/send-otp" method="POST" id="sendOtpForm">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                <div class="mt-1">
                                    <input type="tel" name="contact_no" id="contact_no" required value="{{ auth()->user()->contact_no ?? '' }}" class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="+1 (555) 555-5555">
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <button type="submit" id="otp_send" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Send Verification Code
                                </button>
                            </div>
                        </div>
                    </form>
                    
                    <!-- SMS Code Verification (initially hidden, shown after code is sent) -->
                    <div class="mt-20 hidden" id="verification-form">
                        <div class="text-sm text-gray-600 mb-4">
                            Enter the 6-digit code we sent to your phone number
                        </div>
                        
                        <form action="" method="POST">
                            @csrf
                            <div class="flex justify-between mb-5">
                                <input type="text" name="code[]" maxlength="1" class="w-12 h-12 text-center text-xl border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500" autofocus>
                                <input type="text" name="code[]" maxlength="1" class="w-12 h-12 text-center text-xl border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <input type="text" name="code[]" maxlength="1" class="w-12 h-12 text-center text-xl border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <input type="text" name="code[]" maxlength="1" class="w-12 h-12 text-center text-xl border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <input type="text" name="code[]" maxlength="1" class="w-12 h-12 text-center text-xl border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                                <input type="text" name="code[]" maxlength="1" class="w-12 h-12 text-center text-xl border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            
                            <div class="text-center mb-4">
                                <button id="resendButton" type="button" class="text-sm text-indigo-600 hover:text-indigo-500" disabled>
                                    Resend code (<span id="countdown">60</span>s)
                                </button>
                                
                            </div>
                            
                            <div class="flex items-center">
                                <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Verify & Continue
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Step 2: Authenticator App (hidden initially) -->
                <div class="step-content hidden" id="step-authenticator">
                    <div class="text-center">
                        <h3 class="text-lg font-medium text-gray-900 mb-2">Set up Google Authenticator</h3>
                        <p class="text-sm text-gray-600 mb-6">Scan the QR code with the Google Authenticator app</p>
                        
                        <div class="bg-gray-100 w-48 h-48 mx-auto rounded-md flex items-center justify-center mb-6">
                            <img src="/api/placeholder/200/200" alt="QR Code" class="w-40 h-40">
                        </div>
                        
                        <div class="mb-6">
                            <p class="text-sm text-gray-600 mb-2">Or enter this setup key manually:</p>
                            <div class="bg-gray-100 py-2 px-4 rounded-md inline-block">
                                <code class="text-sm">ABCD EFGH IJKL MNOP</code>
                            </div>
                        </div>
                        
                        <div class="mb-6 bg-blue-50 p-4 rounded-md text-sm text-blue-700">
                            <h4 class="font-medium mb-2">How to set up:</h4>
                            <ol class="text-left pl-5 list-decimal">
                                <li>Download Google Authenticator app</li>
                                <li>Tap the + icon in the app</li>
                                <li>Scan the QR code or enter the setup key</li>
                                <li>Enter the 6-digit code from the app below</li>
                            </ol>
                        </div>
                        
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="auth_code" class="block text-sm font-medium text-gray-700 text-left">Enter 6-digit code from the app</label>
                                <input type="text" name="auth_code" id="auth_code" class="mt-1 appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="000000" maxlength="6">
                            </div>
                            
                            <div class="flex items-center justify-between">
                                <button type="button" class="inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" id="btn-back-to-sms">
                                    Back
                                </button>
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Verify & Complete
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <!-- Step 3: Complete (hidden initially) -->
                <div class="step-content hidden" id="step-complete">
                    <div class="text-center">
                        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">MFA Setup Complete!</h3>
                        <p class="text-sm text-gray-600 mb-6">Your account is now protected with multi-factor authentication</p>
                        
                        <div class="mb-6 bg-yellow-50 p-4 rounded-md text-sm text-yellow-700">
                            <h4 class="font-medium mb-2">Important:</h4>
                            <p>Keep your backup codes safe. You'll need them if you lose access to your phone.</p>
                        </div>
                        
                        <div class="bg-gray-100 py-3 px-4 rounded-md mb-6">
                            <div class="grid grid-cols-2 gap-2 text-sm font-mono text-gray-800">
                                <div>8A7B-9C3F-DE45</div>
                                <div>F123-456G-789H</div>
                                <div>AB12-CD34-EF56</div>
                                <div>GH78-IJ90-KL12</div>
                                <div>MN34-OP56-QR78</div>
                                <div>ST90-UV12-WX34</div>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-center">
                            <button type="button" class="inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Download Backup Codes
                            </button>
                        </div>
                        
                        <div class="mt-6">
                            <a href="/dash" class="text-indigo-600 hover:text-indigo-500 font-medium">Return to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
@endsection