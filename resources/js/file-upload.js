document.getElementById('file_upload').addEventListener('change', function(event) {
    const file = event.target.files[0];
    const preview = document.getElementById('preview_image');
    const fileNameDisplay = document.getElementById('file_name');
    const previewContainer = document.getElementById('file_preview');
    const uploadLabel = document.getElementById('upload_label');
    const changeFileButton = document.getElementById('change_file');

    if (file) {
        const reader = new FileReader();

        reader.onload = function(e) {
            preview.src = e.target.result;
            fileNameDisplay.textContent = file.name;
            previewContainer.classList.remove('hidden');
            uploadLabel.classList.add('hidden');
        };

        reader.readAsDataURL(file);
    }
});

// Handle "Change File" button
document.getElementById('change_file').addEventListener('click', function() {
    const fileInput = document.getElementById('file_upload');
    fileInput.value = ""; // Clear the file input
    fileInput.click(); // Reopen file selection dialog
});

// Text area in accreditation form2 character count
function updateCharCount() {
    let messageField = document.getElementById('message');
    let charCount = document.getElementById('charCount');
    charCount.textContent = `${messageField.value.length} / 300 characters`;
}