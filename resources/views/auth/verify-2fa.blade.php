<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <div class="max-w-md mx-auto mt-10 bg-white shadow-md p-6 rounded-xl">
        <h2 class="text-2xl font-bold mb-4 text-center">Verify OTP</h2>
        
        @if (session('status'))
            <div class="text-green-600 text-sm mb-3">
                {{ session('status') }}
            </div>
        @endif
    
        @if ($errors->any())
            <div class="text-red-600 text-sm mb-3">
                {{ $errors->first('otp') }}
            </div>
        @endif
    
        <form method="POST" action="{{ route('verify.2fa') }}">
            @csrf
    
            <input type="text" name="otp" placeholder="Enter OTP" class="w-full border p-2 rounded mb-4 text-lg" autofocus>
    
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded w-full">Verify</button>
        </form>
    
        <form method="POST" action="{{ route('resend.2fa') }}" class="mt-4 text-center">
            @csrf
            <button type="submit" class="text-blue-600 hover:underline text-sm">Resend OTP</button>
        </form>
    </div>
    
</body>
</html>


