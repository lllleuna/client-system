<form action="/users/create" method="POST" id="create_form">
    @csrf

    <x-form-title>Create Account</x-form-title>

    <x-form-label class="text-blue-900">Business Information</x-form-label>

    <!-- Accreditation Number (Format: YYYY-XXX) -->
    <x-form-input name="accreditation_no" id="accreditation_no" placeholder="Accreditation No. (e.g., 2021-082)" :value="old('accreditation_no')" pattern="^\d{4}-\d{3}$" title="Format should be YYYY-XXX" required/>
    <x-form-error name="accreditation_no" bag="signup"/>

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

    // Eye Opener (Toggle Password Visibility)
    function togglePassword() {
        const passwordInput = document.getElementById("password");
        const eyeIcon = document.getElementById("eyeIcon");

        // Check if elements exist
        if (!passwordInput || !eyeIcon) {
            console.error("Password input or eye icon not found!");
            return;
        }

        // Toggle password visibility
        const isPasswordHidden = passwordInput.type === "password";
        passwordInput.type = isPasswordHidden ? "text" : "password";

        // Update eye icon color or style
        eyeIcon.classList.toggle('text-blue-500', isPasswordHidden); // Blue when visible
        eyeIcon.classList.toggle('text-gray-400', !isPasswordHidden); // Gray when hidden
    }

    // Discard Changes Functionality
function discardChanges() {
    // Clear form fields
    const form = document.getElementById('create_form');
    if (form) {
        form.reset();
        
        // Clear all validation errors from all error bags
        document.querySelectorAll('[class*="text-red-500"]').forEach(el => {
            el.textContent = '';
            el.innerHTML = '';
        });
        
        // Clear any input field styling that might indicate errors
        form.querySelectorAll('input').forEach(input => {
            input.classList.remove('border-red-500');
            input.classList.add('border-gray-300');
        });
    }
    
    // Switch view in Alpine.js
    const alpineComponent = document.querySelector('[x-data]');
    if (alpineComponent && alpineComponent.__x) {
        alpineComponent.__x.$data.currentView = 'selection';
    }
    
    // Hide the modal
    const modal = document.getElementById('modalCreate');
    if (modal) {
        modal.classList.add('hidden');
    }
}

    // Close Modal
    function closeModal(modalId) {
        resetForm('create_form');    // Reset the form when closing
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('hidden'); // Hide the modal
            
            // Also reset the Alpine.js view
            const alpineComponent = document.querySelector('[x-data]');
            if (alpineComponent && alpineComponent.__x) {
                alpineComponent.__x.$data.currentView = 'selection';
            }
        } else {
            console.error(`Modal with ID '${modalId}' not found!`);
        }
    }

    // Reset Form Fields
    function resetForm(formId) {
        const form = document.getElementById(formId);
        if (form) {
            form.reset(); // Clear all form fields
            
            // Clear any validation errors that might be displayed
            const errorElements = form.querySelectorAll('.text-red-500');
            errorElements.forEach(el => {
                el.textContent = '';
            });
        } else {
            console.error(`Form with ID '${formId}' not found!`);
        }
    }

    // Function for the Back button
    function goBackToSelection() {
        resetForm('create_form');    // Reset the form when going back
        
        // Switch view via Alpine.js
        const alpineComponent = document.querySelector('[x-data]');
        if (alpineComponent && alpineComponent.__x) {
            alpineComponent.__x.$data.currentView = 'selection';
        } else {
            console.error("Alpine.js component not found or improperly initialized!");
        }
    }

    // Reset modal view (for X button)
    function resetModalView() {
        resetForm('create_form');    // Reset the form
        closeModal('modalCreate');   // Close the modal
    }

    // Add this to your existing JavaScript in the <script> section:
document.getElementById('create_form').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent the default form submission
    
    const form = this;
    const formData = new FormData(form);
    
    // Make AJAX request to submit the form
    fetch(form.getAttribute('action'), {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Success case
            showNotification('Account created successfully!', 'success');
            
            // Reset form and redirect after a delay
            setTimeout(() => {
                form.reset();
                window.location.href = data.redirect || '/dashboard';
            }, 2000);
        } else {
            // Failure case - validation errors
            showNotification('Failed to create account. Please check the form for errors.', 'error');
            
            // Display validation errors
            if (data.errors) {
                Object.keys(data.errors).forEach(field => {
                    const errorElement = document.querySelector(`[name="${field}"] + .text-red-500`) || 
                                        document.querySelector(`.error-${field}`);
                    if (errorElement) {
                        errorElement.textContent = data.errors[field][0];
                    }
                });
            }
        }
    })
    .catch(error => {
        // Network or server error
        showNotification('An unexpected error occurred. Please try again.', 'error');
        console.error('Error:', error);
    });
});

// Add this function to show notification messages
function showNotification(message, type) {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 p-4 rounded-md shadow-md ${type === 'success' ? 'bg-green-500' : 'bg-red-500'} text-white`;
    notification.innerHTML = message;
    document.body.appendChild(notification);
    
    // Remove notification after 5 seconds
    setTimeout(() => {
        notification.remove();
    }, 5000);
}
</script>
