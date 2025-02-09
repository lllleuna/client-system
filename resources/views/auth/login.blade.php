<form action="/" method="POST" id="log_form" class="w-full max-w-md mx-auto bg-white p-8 rounded-xl shadow-lg">
    @csrf
    
    <div class="space-y-6">
        <!-- Form Header -->
        <div class="text-center">
            <x-form-title class="text-2xl font-bold text-gray-900">Welcome Back</x-form-title>
            <p class="mt-2 text-sm text-gray-600">Please sign in to your account</p>
        </div>

        <!-- Email Field -->
        <div class="space-y-2">
            <div class="relative">
                <x-form-input 
                    name="email" 
                    id="email" 
                    type="email"
                    placeholder="Enter your email" 
                    :value="old('email')" 
                    required
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                />
                <!-- Email Icon -->
                <span class="absolute left-3 top-3.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </span>
            </div>
            <x-form-error name="email" class="text-sm text-red-600" />
        </div>

        <!-- Password Field -->
        <div class="space-y-2">
            <div class="relative">
                <x-form-input 
                    name="password" 
                    id="password" 
                    type="password" 
                    placeholder="Enter your password" 
                    required
                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                />
                <!-- Password Icon -->
                <span class="absolute left-3 top-3.5 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                        <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                    </svg>
                </span>
                <!-- Toggle Password Visibility -->
                <button 
                    type="button" 
                    onclick="togglePassword('password')"
                    class="absolute right-3 top-3.5 text-gray-400 hover:text-gray-600 focus:outline-none"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="toggle-password">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                        <circle cx="12" cy="12" r="3"/>
                    </svg>
                </button>
            </div>
            <x-form-error name="password" class="text-sm text-red-600" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input 
                    type="checkbox" 
                    id="remember" 
                    name="remember" 
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                >
                <label for="remember" class="ml-2 text-sm text-gray-600">Remember me</label>
            </div>
            <a href="{{ route('forgotpassword') }}" class="text-sm text-blue-600 hover:text-blue-800">Forgot password?</a>
        </div>

        <!-- Login Button -->
        <div>
            <x-form-submit-button 
                class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 flex items-center justify-center space-x-2"
            >
                <span>Sign in</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h13M12 5l7 7-7 7"/>
                </svg>
            </x-form-submit-button>
        </div>
    </div>
</form>

<!-- Add this script for password toggle functionality -->
<script>
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = document.querySelector('.toggle-password');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = `
            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/>
            <line x1="1" y1="1" x2="23" y2="23"/>
        `;
    } else {
        input.type = 'password';
        icon.innerHTML = `
            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
            <circle cx="12" cy="12" r="3"/>
        `;
    }
}
</script>