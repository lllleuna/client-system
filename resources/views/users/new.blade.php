<form action="/users/new" method="POST" id="create_form">
    @csrf

    <x-form-title>Create Account</x-form-title>
    {{-- Chairperson's Name --}}
    <x-form-label class="text-blue-900">Cooperative Chairperson's Personal Information</x-form-label>

    <div class="flex">
        <x-form-input name="chair_fname" id="chair_fname" placeholder="First Name" :value="old('chair_fname')" pattern="^[A-Za-z\s\-']+$" title="Only letters, spaces, hyphens, and apostrophes are allowed" required/>
        <x-form-input name="chair_mname" id="chair_mname" placeholder="Middle Name" :value="old('chair_mname')" pattern="^[A-Za-z\s\-']*$" title="Only letters, spaces, hyphens, and apostrophes are allowed"/>
    </div>

    <div class="flex">
        <x-form-error name="chair_fname" bag="signup"/>
        <x-form-error name="chair_mname" bag="signup"/>
    </div>

    <div class="flex">
        <x-form-input name="chair_lname" id="chair_lname" placeholder="Last Name" :value="old('chair_lname')" pattern="^[A-Za-z\s\-']+$" title="Only letters, spaces, hyphens, and apostrophes are allowed" required/>
        <x-form-input name="chair_suffix" id="chair_suffix" placeholder="Suffix" :value="old('chair_suffix')" pattern="^[A-Za-z.]*$" title="Only letters and periods are allowed"/>
    </div>

    <div class="flex">
        <x-form-error name="chair_lname" bag="signup"/>
        <x-form-error name="chair_suffix" bag="signup"/>
    </div>

    <!-- Contact Number (11 Digits Only) -->
    <x-form-input name="contact_no" id="contact_no" placeholder="Contact No. (11 digits)" :value="old('contact_no')" pattern="^\d{11}$" title="Contact number must be exactly 11 digits" required/>
    <x-form-error name="contact_no" bag="signup"/>

    <x-form-label class="text-blue-900">Account Information</x-form-label>

    <!-- Business Email -->
    <x-form-input name="email" id="email" placeholder="Business Official Email" :value="old('email')" type="email" required/>
    <x-form-error name="email" bag="signup"/>

    {{-- Password --}}
    <div class="relative">
        <x-form-input name="password" id="password" type="password" placeholder="Password (Min. 12 characters, with letters & numbers)" pattern="^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d@$!%*#?&]{12,}$" title="Minimum 12 characters, include at least one letter and one number" required class="pr-10"/>
        <x-form-error name="password" bag="signup"/>
    
        <!-- Eye Icon Button -->
        <button type="button" onclick="togglePassword()" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 focus:outline-none">
            <svg id="eyeIcon" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path id="eyePath" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path id="eyeOutline" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
        </button>
    </div>

    <!-- Confirm Password -->
    <x-form-input name="password_confirmation" id="password_confirmation" type="password" placeholder="Confirm Password" required/>
    <x-form-error name="password_confirmation" bag="signup"/>

    <div class="flex justify-between mt-2 mb-2">
        <div>
            <x-cancel-button onclick="discardChanges()">Discard</x-cancel-button>        
        </div>
        <div>
            <x-form-submit-button>Create</x-form-submit-button>
        </div>
    </div>
</form>

<script>
    // Password Confirmation Validation
    document.getElementById('create_form').addEventListener('submit', function(event) {
        const password = document.getElementById('password').value;
        const confirmPassword = document.getElementById('password_confirmation').value;

        if (password !== confirmPassword) {
            event.preventDefault();
            alert('Passwords do not match!');
        }
    });

    // Eye Opener
// Eye Opener
function togglePassword() {
    const passwordInput = document.getElementById("password");
    const confirmPasswordInput = document.getElementById("password_confirmation");
    const eyeIcon = document.getElementById("eyeIcon");

    // Check if password input exists
    if (!passwordInput) {
        console.error("Password input not found!");
        return;
    }

    // Toggle password visibility
    const isCurrentlyPassword = passwordInput.type === "password";
    
    // Change the type
    passwordInput.type = isCurrentlyPassword ? "text" : "password";
    
    // Also toggle confirmation field if it exists
    if (confirmPasswordInput) {
        confirmPasswordInput.type = isCurrentlyPassword ? "text" : "password";
    }

    // Update eye icon - if eye icon exists
    if (eyeIcon) {
        if (isCurrentlyPassword) {
            // Password is now visible
            eyeIcon.classList.add('text-blue-500');
            eyeIcon.classList.remove('text-gray-500');
        } else {
            // Password is now hidden
            eyeIcon.classList.remove('text-blue-500');
            eyeIcon.classList.add('text-gray-500');
        }
    }
    
    // Log the current state to debug
    console.log("Password visibility toggled. Current type:", passwordInput.type);
}

// Discard Changes Functionality
function discardChanges() {
    resetForm('create_form');
    closeModal('modalCreate');
}

// Reset Form Fields
function resetForm(formId) {
    const form = document.getElementById(formId);
    if (form) {
        form.reset(); // Clear all form fields
        
        // Clear any validation errors that might be displayed
        form.querySelectorAll('[class*="text-red-500"]').forEach(el => {
            el.textContent = '';
        });
    }
}

// Close Modal
function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden'); // Hide the modal
        
        // Also reset the Alpine.js view if applicable
        const alpineComponent = document.querySelector('[x-data]');
        if (alpineComponent && alpineComponent.__x) {
            alpineComponent.__x.$data.currentView = 'selection';
        }
    }
}
</script>
