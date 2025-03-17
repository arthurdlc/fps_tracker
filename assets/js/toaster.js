function showToaster(message) {
    var toaster = document.createElement('div');
    toaster.classList.add('toaster');
    toaster.innerText = message;
    document.body.appendChild(toaster);

    setTimeout(function() {
        toaster.remove();
    }, 5000);
}
