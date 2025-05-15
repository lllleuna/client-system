<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Transport Coop')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100">
    <!-- Session Expired Modal -->
    <div id="session-expired-modal"
        class="hidden fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-80 text-center">
            <h2 class="text-lg font-semibold mb-4">Session Expired</h2>
            <p class="mb-4">Your session has expired. Please login again.</p>
            <button id="session-expired-ok"
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded">OK</button>
        </div>
    </div>


    {{-- Include Navbar --}}
    @include('partials.navbar')

    {{-- Main Content --}}
    <div class="container mx-auto p-4">
        @yield('content')
    </div>

    <script>
        let lastActivity = Date.now();
        const sessionLifetimeMinutes = {{ config('session.lifetime') }};
        const checkInterval = 30000; // Check every 30 seconds

        document.addEventListener('mousemove', () => lastActivity = Date.now());
        document.addEventListener('keydown', () => lastActivity = Date.now());

        setInterval(() => {
            const now = Date.now();
            const inactiveMinutes = (now - lastActivity) / 1000 / 60;

            if (inactiveMinutes >= sessionLifetimeMinutes) {
                showSessionExpiredModal();
            }
        }, checkInterval);

        function showSessionExpiredModal() {
            document.getElementById('session-expired-modal').classList.remove('hidden');
        }

        document.getElementById('session-expired-ok').addEventListener('click', function() {
            window.location.href = "{{ route('logout') }}";
        });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


</body>

</html>
