{{-- resources/views/components/cgs-modals.blade.php --}}

{{-- Initial CGS Application Modal --}}
<div id="cgsInitialModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">CGS Application Confirmation</h3>
            <p class="mb-6 text-gray-600">Are you applying for a Certificate of Good Standing (CGS)?</p>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="proceedToDateSelection()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">Yes</button>
                <button type="button" onclick="cancelApplication()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">No</button>
            </div>
        </div>
    </div>
</div>

{{-- Date Selection Modal --}}
<div id="dateSelectionModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Last CGS Renewal Date</h3>
            <div class="mb-6">
                <label for="lastRenewalDate" class="block text-sm font-medium text-gray-700 mb-2">When was your last renewal?</label>
                <input type="date" id="lastRenewalDate" class="w-full border border-gray-300 rounded-md p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                <p class="mt-2 text-sm text-gray-500">This helps us determine your renewal eligibility</p>
            </div>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="checkRenewalPeriod()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">Continue</button>
                <button type="button" onclick="cancelApplication()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{-- Confirmation Modal --}}
<div id="confirmationModal" class="fixed inset-0 bg-gray-500 bg-opacity-75 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg p-8 max-w-md w-full">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Confirm Submission</h3>
            <p class="mb-6 text-gray-600">You are about to submit your CGS request. Please confirm that all documents are complete and accurate.</p>
            <div class="flex justify-end space-x-4">
                <button type="button" onclick="submitForm()" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">Submit</button>
                <button type="button" onclick="hideConfirmationModal()" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition-colors">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{-- Success Notification --}}
@if(session('success'))
<div id="successNotification" class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-4 rounded-lg shadow-lg z-50">
    <p>CGS Request submitted successfully!</p>
</div>
@endif

{{-- Error Notification --}}
@if(session('error'))
<div id="errorNotification" class="fixed bottom-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50">
    <p>Error: Please check your uploaded documents and try again.</p>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Show initial modal
    document.getElementById('cgsInitialModal').classList.remove('hidden');

    // Initialize notifications
    const successNotification = document.getElementById('successNotification');
    const errorNotification = document.getElementById('errorNotification');

    if (successNotification || errorNotification) {
        setTimeout(() => {
            if (successNotification) successNotification.remove();
            if (errorNotification) errorNotification.remove();
        }, 5000);
    }
});

function proceedToDateSelection() {
    document.getElementById('cgsInitialModal').classList.add('hidden');
    document.getElementById('dateSelectionModal').classList.remove('hidden');
}

function cancelApplication() {
    window.location.href = '{{ url('/dash') }}';
}

function checkRenewalPeriod() {
    const lastRenewalDate = new Date(document.getElementById('lastRenewalDate').value);
    const today = new Date();
    const monthsDiff = (today.getFullYear() - lastRenewalDate.getFullYear()) * 12 + 
                      (today.getMonth() - lastRenewalDate.getMonth());

    document.getElementById('dateSelectionModal').classList.add('hidden');

    if (monthsDiff < 11) {
        if (confirm("You're submitting earlier than your scheduled renewal. Are you sure you want to proceed?")) {
            showMainForm();
        } else {
            cancelApplication();
        }
    } else if (monthsDiff >= 11 && monthsDiff <= 12) {
        alert("Perfect! Proceed with the document submission.");
        showMainForm();
    } else {
        if (confirm("This submission is past the renewal date. Late submissions may affect your standing. Do you still want to proceed?")) {
            showMainForm();
        } else {
            cancelApplication();
        }
    }
}

function showMainForm() {
    document.getElementById('cgsApplicationForm').classList.remove('hidden');
}


function submitForm() {
    const submitButton = document.querySelector('button[type="submit"]');
    submitButton.disabled = true;
    submitButton.innerHTML = 'Submitting...';
    document.querySelector('form').submit();
}

function hideConfirmationModal() {
    document.getElementById('confirmationModal').classList.add('hidden');
}
</script>