<form action="/" method="POST" id="log_form">
    @csrf
    
    <div class="text-center mb-6">
        <x-form-title class="text-2xl font-bold text-gray-900">Welcome Back</x-form-title>
        <p class="mt-2 text-sm text-gray-600">Please sign in to your account</p>
    </div>

    <x-form-input name="email" id="email" placeholder="Email" :value="old('email')" required/>
    <x-form-error name="email" />

    <x-form-input name="password" id="password" type="password" placeholder="Password" required/>
    <x-form-error name="password" />

    <!-- Login Button -->
    <div class="mt-6">
        <x-form-submit-button 
            class="w-full py-3 px-4 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition duration-200 flex items-center justify-center space-x-2"
        >
            <span>Sign in</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M5 12h13M12 5l7 7-7 7"/>
            </svg>
        </x-form-submit-button>
    </div>

</form>
