<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>
<body class="bg-gray-100">

    <nav class="bg-gray-900 text-white py-4 px-6 flex justify-between items-center relative">
        <!-- Left Section: Logo -->
        <div class="flex items-center space-x-3">
            <img src="https://via.placeholder.com/40" alt="Logo" class="h-8 w-8 rounded-full">
            <span class="text-lg font-semibold">Office of Transportation Cooperatives - Client Portal</span>
        </div>
        <!-- Center Section: Navigation Links -->
        <div class="flex space-x-6">
            <a href="{{ url('/dash') }}" class="hover:text-gray-300 transition">Dashboard</a>
            <a href="{{ route('infoupdate') }}" class="hover:text-gray-300 transition">My Information</a>
            <!-- Services Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open" class="hover:text-gray-300 transition flex items-center">
                    Services ▼
                </button>
                <div 
                    x-show="open" 
                    @click.away="open = false"
                    class="absolute left-0 mt-2 w-48 bg-white text-black rounded-lg shadow-lg z-50"
                >
                    <a href="#" class="block px-4 py-2 hover:bg-gray-200">Certificate of Good Standing</a>
                    <a href="{{ route('training') }}" class="block px-4 py-2 hover:bg-gray-200">Training & Seminars</a>
                </div>
            </div>
        </div>
        <!-- Right Section: Actions -->
        <div class="flex items-center space-x-6">
            <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition">
                Send Message
            </button>
            <!-- Bell Icon -->
            <button class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-300 hover:text-white transition" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12 2C10.343 2 9 3.343 9 5V6C6.243 6 4 8.243 4 11V16L2 18V19H22V18L20 16V11C20 8.243 17.757 6 15 6V5C15 3.343 13.657 2 12 2ZM6 11C6 9.346 7.346 8 9 8H15C16.654 8 18 9.346 18 11V16H6V11ZM10 21C10 22.104 10.896 23 12 23C13.104 23 14 22.104 14 21H10Z"/>
                </svg>
            </button>
            <!-- Profile Icon -->
            <img src="https://via.placeholder.com/40" alt="Profile" class="h-8 w-8 rounded-full">
        </div>
    </nav>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById("dropdown");
            if (dropdown.classList.contains("opacity-0")) {
                dropdown.classList.remove("opacity-0", "invisible");
            } else {
                dropdown.classList.add("opacity-0", "invisible");
            }
        }

        // Close dropdown when clicking outside
        document.addEventListener("click", function(event) {
            const dropdown = document.getElementById("dropdown");
            const button = event.target.closest("button");
            if (!dropdown.contains(event.target) && !button) {
                dropdown.classList.add("opacity-0", "invisible");
            }
        });
    </script>

</body>
</html>
