@extends('layouts.layout')

@section('content')

<div class="py-12">
    <div class="max-w-md mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800 mb-6">SMS Verification</h2>
                
                <div id="phone-form" class="transition-opacity duration-300">
                    <form id="verify-phone-form" method="POST" action="{{ route('verify.phone') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="contact_no" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                            <input type="text" name="contact_no" id="contact_no" value="{{ auth()->user()->contact_no }}" 
                            class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="63 900 000 0000">
                            <p class="mt-1 text-sm text-gray-500">We'll send a verification code to this number</p>
                        </div>
                        
                        <button type="submit" id="send-otp-btn" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Send Verification Code
                        </button>
                    </form>
                </div>
                
                <div id="otp-form" class="mt-8 hidden transition-opacity duration-300">
                    <form id="verify-otp-form" method="POST" action="{{ route('verify.otp') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="otp" class="block text-sm font-medium text-gray-700 mb-1">Verification Code</label>
                            <div class="flex space-x-2 mb-2">
                                <input type="text" maxlength="1" class="otp-input w-full h-12 text-center text-lg font-semibold border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <input type="text" maxlength="1" class="otp-input w-full h-12 text-center text-lg font-semibold border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <input type="text" maxlength="1" class="otp-input w-full h-12 text-center text-lg font-semibold border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <input type="text" maxlength="1" class="otp-input w-full h-12 text-center text-lg font-semibold border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <input type="text" maxlength="1" class="otp-input w-full h-12 text-center text-lg font-semibold border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                                <input type="text" maxlength="1" class="otp-input w-full h-12 text-center text-lg font-semibold border border-gray-300 rounded-md focus:ring-indigo-500 focus:border-indigo-500">
                            </div>
                            <input type="hidden" name="otp" id="otp-value">
                            <p id="otp-message" class="mt-1 text-sm text-gray-500">Enter the 6-digit code sent to your phone</p>
                        </div>
                        
                        <div class="flex items-center justify-between mb-4">
                            <button type="button" id="resend-otp-btn" disabled 
                                class="text-sm text-indigo-600 hover:text-indigo-500 disabled:text-gray-400 disabled:cursor-not-allowed">
                                Resend Code (<span id="timer">0:60</span>)
                            </button>
                        </div>
                        
                        <button type="submit" 
                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Verify Code
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Simulate form submission and show OTP form
    document.getElementById('verify-phone-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Disable the phone form
        const phoneForm = document.getElementById('phone-form');
        phoneForm.classList.add('opacity-50');
        phoneForm.querySelectorAll('input, button').forEach(el => el.disabled = true);
        
        // Show OTP form
        document.getElementById('otp-form').classList.remove('hidden');
        
        // Start countdown timer
        startCountdown();
        
        // Setup OTP inputs
        setupOtpInputs();
    });
    
    // Handle OTP input auto-advance
    function setupOtpInputs() {
        const inputs = document.querySelectorAll('.otp-input');
        
        inputs.forEach((input, index) => {
            input.addEventListener('keyup', function(e) {
                // Move to next input when a number is entered
                if (e.key >= 0 && e.key <= 9) {
                    input.value = e.key;
                    if (index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    updateOtpValue();
                }
                // Move to previous input when backspace is pressed
                else if (e.key === 'Backspace') {
                    input.value = '';
                    if (index > 0) {
                        inputs[index - 1].focus();
                    }
                    updateOtpValue();
                }
            });
            
            // Handle paste event
            input.addEventListener('paste', function(e) {
                e.preventDefault();
                const pasteData = e.clipboardData.getData('text');
                if (/^\d+$/.test(pasteData)) {
                    for (let i = 0; i < inputs.length; i++) {
                        if (i < pasteData.length) {
                            inputs[i].value = pasteData[i];
                        }
                    }
                    updateOtpValue();
                }
            });
        });
        
        // Focus first input
        inputs[0].focus();
    }
    
    // Combine OTP inputs into hidden field
    function updateOtpValue() {
        const inputs = document.querySelectorAll('.otp-input');
        let otp = '';
        inputs.forEach(input => {
            otp += input.value;
        });
        document.getElementById('otp-value').value = otp;
    }
    
    // Countdown timer for resend button
    function startCountdown() {
        const timerElement = document.getElementById('timer');
        const resendButton = document.getElementById('resend-otp-btn');
        let timeLeft = 60;
        
        const countdownInterval = setInterval(() => {
            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerElement.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
            
            if (timeLeft <= 0) {
                clearInterval(countdownInterval);
                resendButton.disabled = false;
                timerElement.textContent = '0:00';
            }
        }, 1000);
        
        // Handle resend button click
        resendButton.addEventListener('click', function() {
            if (!resendButton.disabled) {
                // Disable button and restart timer
                resendButton.disabled = true;
                timeLeft = 60;
                startCountdown();
                
                // Make AJAX request to resend OTP
                fetch('{{ route("resend.otp") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        contact_no: document.getElementById('contact_no').value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.getElementById('otp-message').textContent = 'A new code has been sent to your phone';
                    }
                });
            }
        });
    }
</script>

@endsection