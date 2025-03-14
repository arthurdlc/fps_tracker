// Exemple d'envoi de demande d'ami via AJAX
document.getElementById("addFriendForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('php/add_friend.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if(data.status === "success") {
            alert(data.message);
        } else {
            alert(data.message);
        }
    })
    .catch(error => console.error('Error:', error));
});
