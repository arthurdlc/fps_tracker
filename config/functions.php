<?php
// Vérifie si la fonction 'redirect' existe déjà avant de la déclarer
if (!function_exists('redirect')) {
    function redirect($url) {
        header('Location: ' . $url);
        exit;
    }
}

// Vérifie si la fonction 'isLoggedIn' existe déjà avant de la déclarer
if (!function_exists('isLoggedIn')) {
    function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
}

// Vérifie si la fonction 'isAdmin' existe déjà avant de la déclarer
if (!function_exists('isAdmin')) {
    function isAdmin() {
        return isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'; // Assurez-vous que le rôle est stocké dans la session
    }
}
?>
