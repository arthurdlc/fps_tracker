document.addEventListener('DOMContentLoaded', function() {
    let toast = document.querySelector('.toaster');
    if (toast) {
        toast.style.display = 'block';
        setTimeout(function() {
            toast.style.display = 'none';
        }, 5000);
    }
});
