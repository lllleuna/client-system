<form action="/" method="POST" id="log_form">
    @csrf

    <div class="text-center mb-6">
        <x-form-title class="text-2xl font-bold text-gray-900">Welcome!</x-form-title>
        <p class="text-sm text-gray-600">Please sign in to your account</p>
    </div>

    <x-form-input
        name="email_login"
        id="email"
        type="email"
        placeholder="Email"
        :value="old('email_login')"
        required
        pattern="^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$"
        title="Please enter a valid email address"
    />
    <x-form-error name="email_login" bag="login" />

    <div class="relative">
        <x-form-input
            name="password"
            id="password"
            type="password"
            placeholder="Password"
            required
            minlength="12"
            title="Password must be at least 12 characters long"
            class="pr-10"
        />
        <button
            type="button"
            id="togglePassword"
            class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-600 cursor-pointer"
            aria-label="Toggle password visibility"
        >
            <!-- Eye icon (show password) -->
            <svg xmlns="http://www.w3.org/2000/svg" id="showPasswordIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="block">
                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
            <!-- Eye-off icon (hide password) -->
            <svg xmlns="http://www.w3.org/2000/svg" id="hidePasswordIcon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="hidden">
                <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path>
                <line x1="1" y1="1" x2="23" y2="23"></line>
            </svg>
        </button>
    </div>
    <x-form-error name="password" bag="login" />

    <div class="text-center mt-4">
        <div></div> <!-- Empty div to push forgot password to the right -->
        <a href="/forgot-password" class="text-sm text-blue-600 hover:text-blue-800 transition duration-200">
            Forgot password?
        </a>
    </div>

    <div class="mt-6">
        <x-form-submit-button
            id="login-button"
            class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 flex items-center justify-center space-x-2"
        >
            <span>Sign in</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h13M12 5l7 7-7 7"/>
            </svg>
        </x-form-submit-button>
    </div>

    @if(session('lockout_time'))
    <div id="lockout-message" class="text-red-600 text-sm mt-4">
        Too many login attempts. Please try again in <span id="countdown">{{ session('lockout_time') }}</span> seconds.
    </div>

    <script>
        let timeLeft = {{ session('lockout_time') }};
        const countdownElement = document.getElementById("countdown");
        const loginButton = document.getElementById("login-button");

        // Disable login button
        loginButton.disabled = true;
        loginButton.classList.add("opacity-50", "cursor-not-allowed");

        function updateCountdown() {
            if (timeLeft > 0) {
                timeLeft--;
                countdownElement.textContent = timeLeft;
                setTimeout(updateCountdown, 1000);
            } else {
                // Remove lockout message
                document.getElementById("lockout-message").remove();

                // Enable login button
                loginButton.disabled = false;
                loginButton.classList.remove("opacity-50", "cursor-not-allowed");
            }
        }

        updateCountdown();
    </script>
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButton = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const showIcon = document.getElementById('showPasswordIcon');
            const hideIcon = document.getElementById('hidePasswordIcon');

            toggleButton.addEventListener('click', function() {
                // Toggle the password input type
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    showIcon.classList.add('hidden');
                    showIcon.classList.remove('block');
                    hideIcon.classList.add('block');
                    hideIcon.classList.remove('hidden');
                } else {
                    passwordInput.type = 'password';
                    showIcon.classList.add('block');
                    showIcon.classList.remove('hidden');
                    hideIcon.classList.add('hidden');
                    hideIcon.classList.remove('block');
                }
            });
        });
    </script>
</form>
