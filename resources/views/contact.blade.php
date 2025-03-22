@extends('layouts.app')
@section('title', 'Contact Us')
@section('content')
    <div class="max-w-2xl mx-auto mt-10">
        <h1 class="text-3xl font-bold mb-4">Contact Us</h1>
        <p class="text-gray-600 mb-6">Feel free to reach out to us for any inquiries.</p>
        
        <!-- Success Message (hidden by default) -->
        <div id="successMessage" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 hidden">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">Your message has been sent successfully.</span>
        </div>
        
        <!-- Error Message (hidden by default) -->
        <div id="errorMessage" class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 hidden">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">There was a problem sending your message. Please try again.</span>
        </div>
        
        <form action="{{ route('contact.store') }}" method="POST" class="mt-4" id="contactForm">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" id="name" name="name" required class="w-full p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Your name">
            </div>
            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" id="email" name="email" required class="w-full p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Your email address">
            </div>
            <div class="mb-4">
                <label for="message" class="block text-gray-700">Message</label>
                <textarea id="message" name="message" required class="w-full p-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-600" placeholder="Your message"></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-600">Send</button>
        </form>
        <!-- Contact Information Section -->
        <div class="mt-10 bg-gray-50 p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Office Information</h2>
            <p class="text-gray-600 mb-2"><strong>Address:</strong> 5th Floor Ben-Lor Bldg., Brgy. Paligsahan, 1184 Quezon Avenue, Quezon City 1103</p>
            <p class="text-gray-600 mb-2"><strong>Email:</strong> <a href="mailto:official@otc.gov.ph" class="text-blue-600">official@otc.gov.ph</a></p>
            <p class="text-gray-600 mb-2"><strong>Cellphone:</strong> 09989461736 / 09772111310</p>
            <p class="text-gray-600 mb-2"><strong>Telephone:</strong> (02) 8332-9315</p>
            <p class="text-gray-600 mb-2"><strong>Facebook:</strong> <a href="https://www.facebook.com/DOTR.OTC" class="text-blue-600" target="_blank">DOTR.OTC</a></p>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Fixed the form selector by adding an ID to the form and using it here
    const contactForm = document.getElementById('contactForm');
    const nameInput = document.getElementById('name');
    const emailInput = document.getElementById('email');
    const messageInput = document.getElementById('message');
    const successMessage = document.getElementById('successMessage');
    const errorMessage = document.getElementById('errorMessage');
   
    // Function to show error message
    function showError(input, message) {
        const errorElement = document.createElement('p');
        errorElement.className = 'text-red-500 text-sm mt-1';
        errorElement.textContent = message;
       
        // Remove any existing error message
        const existingError = input.parentElement.querySelector('.text-red-500');
        if (existingError) {
            existingError.remove();
        }
       
        // Add error class to input
        input.classList.add('border-red-500');
       
        // Add error message after input
        input.parentElement.appendChild(errorElement);
    }
   
    // Function to remove error message
    function removeError(input) {
        const existingError = input.parentElement.querySelector('.text-red-500');
        if (existingError) {
            existingError.remove();
        }
        input.classList.remove('border-red-500');
    }
   
    // Validate email format
    function isValidEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }
   
    // Function to show success message
    function showSuccessMessage() {
        // Hide any existing error message
        errorMessage.classList.add('hidden');
        // Show success message
        successMessage.classList.remove('hidden');
        // Reset form
        contactForm.reset();
        // Scroll to message
        successMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
        // Hide message after 5 seconds
        setTimeout(() => {
            successMessage.classList.add('hidden');
        }, 5000);
    }
    
    // Function to show error message
    function showErrorMessage() {
        // Hide any existing success message
        successMessage.classList.add('hidden');
        // Show error message
        errorMessage.classList.remove('hidden');
        // Scroll to message
        errorMessage.scrollIntoView({ behavior: 'smooth', block: 'center' });
        // Hide message after 5 seconds
        setTimeout(() => {
            errorMessage.classList.add('hidden');
        }, 5000);
    }
   
    // Form submission handler
    contactForm.addEventListener('submit', function(event) {
        let isValid = true;
       
        // Reset previous errors
        removeError(nameInput);
        removeError(emailInput);
        removeError(messageInput);
       
        // Validate name
        if (nameInput.value.trim() === '') {
            showError(nameInput, 'Please enter your name');
            isValid = false;
        }
       
        // Validate email
        if (emailInput.value.trim() === '') {
            showError(emailInput, 'Please enter your email address');
            isValid = false;
        } else if (!isValidEmail(emailInput.value.trim())) {
            showError(emailInput, 'Please enter a valid email address');
            isValid = false;
        }
       
        // Validate message
        if (messageInput.value.trim() === '') {
            showError(messageInput, 'Please enter your message');
            isValid = false;
        } else if (messageInput.value.trim().length < 10) {
            showError(messageInput, 'Your message must be at least 10 characters long');
            isValid = false;
        }
       
        // Prevent form submission if validation fails
        if (!isValid) {
            event.preventDefault();
            return;
        }
        
        // If using AJAX submission (remove this preventDefault if you want traditional form submission)
        event.preventDefault();
        
        // This is a placeholder for the actual form submission
        // In a real implementation, you would use fetch or XMLHttpRequest to submit the form data
        // Example with fetch (commented out as placeholder):
        /*
        fetch('{{ route('contact.store') }}', {
            method: 'POST',
            body: new FormData(contactForm),
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            }
        })
        .then(response => {
            if (response.ok) {
                showSuccessMessage();
            } else {
                showErrorMessage();
            }
        })
        .catch(error => {
            showErrorMessage();
        });
        */
        
        // For demo purposes, we'll simulate a successful submission
        // Remove this in production and uncomment the fetch code above
        setTimeout(() => {
            showSuccessMessage();
            // Uncomment the line below to test the error message
            // showErrorMessage();
        }, 1000);
    });
   
    // Real-time validation on input
    nameInput.addEventListener('input', function() {
        if (nameInput.value.trim() !== '') {
            removeError(nameInput);
        }
    });
   
    emailInput.addEventListener('input', function() {
        if (emailInput.value.trim() !== '' && isValidEmail(emailInput.value.trim())) {
            removeError(emailInput);
        }
    });
   
    messageInput.addEventListener('input', function() {
        if (messageInput.value.trim() !== '' && messageInput.value.trim().length >= 10) {
            removeError(messageInput);
        }
    });
});
</script>