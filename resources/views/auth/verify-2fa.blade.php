<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OTP Verification</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center p-4">

    <div class="max-w-md w-full mx-auto bg-white shadow-lg rounded-2xl overflow-hidden">
        <!-- Header with wave design -->
        <div class="bg-gradient-to-r from-blue-500 to-indigo-600 pt-8 pb-16 px-6 relative">
            <h2 class="text-2xl font-bold text-white text-center">Security Verification</h2>
            <p class="text-blue-100 text-center mt-2">Enter the 6-digit code sent to your device</p>
            
            <!-- Wave shape at bottom of header -->
            <div class="absolute bottom-0 left-0 right-0">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full">
                    <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
                </svg>
            </div>
        </div>

        <!-- Form content -->
        <div class="px-6 pt-4 pb-8 -mt-6 relative z-10">
            <!-- OTP verification icon -->
            <div class="mb-6 text-center">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-blue-100 text-blue-600 mb-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
            </div>
            
            @if (session('status'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700">
                                {{ session('status') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                {{ $errors->first('otp') }}
                            </p>
                        </div>
                    </div>
                </div>
            @endif
        
            <form method="POST" action="{{ route('verify.2fa') }}">
                @csrf
                
                <div class="mb-6">
                    <label for="otp" class="block text-sm font-medium text-gray-700 mb-2">One-Time Password</label>
                    <input 
                        type="text" 
                        id="otp"
                        name="otp" 
                        placeholder="Enter 6-digit code" 
                        class="block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 text-center text-2xl tracking-widest" 
                        maxlength="6" 
                        pattern="[0-9]{6}" 
                        inputmode="numeric"
                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                        autocomplete="one-time-code"
                        autofocus
                        required
                    >
                    <p class="mt-2 text-xs text-gray-500">Please enter the 6-digit verification code sent to your device</p>
                </div>
        
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium py-3 px-4 rounded-lg hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-300 shadow-md"
                >
                    Verify Code
                </button>
            </form>
        
            <div class="mt-6 flex items-center justify-between">
                <span class="border-t border-gray-200 w-full"></span>
                <span class="text-xs text-gray-500 mx-3">OR</span>
                <span class="border-t border-gray-200 w-full"></span>
            </div>
            
            <form method="POST" action="{{ route('resend.2fa') }}" class="mt-6">
                @csrf
                <button 
                    type="submit" 
                    class="w-full bg-white border border-gray-300 text-gray-700 font-medium py-3 px-4 rounded-lg hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300"
                >
                    Resend Code
                </button>
            </form>
            
            <!-- Timer -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-500">Code expires in <span id="timer" class="font-medium text-blue-600">5:00</span></p>
            </div>
        </div>
    </div>

    <script>
        // Timer countdown
        function startTimer(duration, display) {
            let timer = duration, minutes, seconds;
            const interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.textContent = minutes + ":" + seconds;

                if (--timer < 0) {
                    clearInterval(interval);
                    display.textContent = "Expired";
                    display.classList.remove("text-blue-600");
                    display.classList.add("text-red-600");
                }
            }, 1000);
        }

        // OTP input restrictions and format
        document.addEventListener('DOMContentLoaded', function() {
            // Start timer (5 minutes)
            const fiveMinutes = 60 * 5;
            const display = document.querySelector('#timer');
            startTimer(fiveMinutes, display);
            
            // Focus on OTP input
            document.getElementById('otp').focus();
        });
    </script>
</body>
</html>