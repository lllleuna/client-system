@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 p-4">
    <div class="w-full max-w-lg bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center text-gray-900 mb-4">Reset Password</h2>

        @if ($errors->any())
            <div class="mb-4 text-red-500 text-center text-sm">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form id="reset-password-form" method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            {{-- Password Field --}}
            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                <input type="password" name="password" id="password" class="w-full px-4 py-2 border border-gray-300 rounded-md pr-10" required>
                <button type="button" class="absolute right-3 top-9 text-sm text-gray-600" id="toggle-password">Show</button>
                <p id="password-error" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            {{-- Confirm Password Field --}}
            <div class="mb-4 relative">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-md pr-10" required>
                <button type="button" class="absolute right-3 top-9 text-sm text-gray-600" id="toggle-confirm-password">Show</button>
                <p id="confirm-password-error" class="text-red-500 text-xs mt-1 hidden"></p>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700">
                Reset Password
            </button>
        </form>
    </div>
</div>

{{-- Validation & Toggle Script --}}
<script>
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('password_confirmation');
    const passwordError = document.getElementById('password-error');
    const confirmPasswordError = document.getElementById('confirm-password-error');

    const complexityRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{12,}$/;

    function validatePassword() {
        const password = passwordInput.value;
        if (!complexityRegex.test(password)) {
            passwordError.textContent = "Password must be at least 12 characters and contain uppercase, lowercase, number, and special character.";
            passwordError.classList.remove('hidden');
        } else {
            passwordError.classList.add('hidden');
        }
        validateConfirmPassword();
    }

    function validateConfirmPassword() {
        if (confirmPasswordInput.value !== passwordInput.value) {
            confirmPasswordError.textContent = "Password confirmation does not match.";
            confirmPasswordError.classList.remove('hidden');
        } else {
            confirmPasswordError.classList.add('hidden');
        }
    }

    passwordInput.addEventListener('input', validatePassword);
    confirmPasswordInput.addEventListener('input', validateConfirmPassword);

    document.getElementById('reset-password-form').addEventListener('submit', function(e) {
        validatePassword();
        validateConfirmPassword();

        if (!complexityRegex.test(passwordInput.value) || (confirmPasswordInput.value !== passwordInput.value)) {
            e.preventDefault();
        }
    });

    // Toggle Password Visibility
    document.getElementById('toggle-password').addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.textContent = type === 'password' ? 'Show' : 'Hide';
    });

    document.getElementById('toggle-confirm-password').addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.textContent = type === 'password' ? 'Show' : 'Hide';
    });
</script>
@endsection
