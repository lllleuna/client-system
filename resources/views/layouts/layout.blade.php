<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Transport Coop')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body class="bg-gray-100">

    {{-- Include Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <div class="container mx-auto p-4">
        @yield('content')
    </div>

</body>
</html>
