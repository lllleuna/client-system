<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Did not recieve?</h2>
    <h3>Verify email again</h3>

    @if (session('message'))
        <p class="text-green-500">{{ session('message') }}</p>
    @endif

    <form action="{{ route('verification.send') }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Resend Verification Email</button>
    </form>
</body>
</html>