window.openModal = function(modalId) {
    document.getElementById(modalId).style.display = 'block'
    document.getElementsByTagName('body')[0].classList.add('overflow-y-hidden')
}

window.closeModal = function(modalId) {
    document.getElementById(modalId).style.display = 'none'
    document.getElementsByTagName('body')[0].classList.remove('overflow-y-hidden')
}

window.resetForm = function(formId) {
    const form = document.getElementById(formId);
    if (form) {
        form.reset(); 
    }
}

document.addEventListener("DOMContentLoaded", function () {
    if (document.querySelector(".modal-error")) {
        openModal("modelConfirm");
    }
});
