<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Vérifier si l'utilisateur existe
    $stmt = $pdo->prepare("SELECT * FROM JOUEUR WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user["mot_de_passe"])) {
        $_SESSION["user_id"] = $user["id_joueur"];
        $_SESSION["pseudo"] = $user["pseudo"];
        header("Location: dashboard.php");
        exit;
    } else {
        echo json_encode(["status" => "error", "message" => "Identifiants incorrects"]);
    }
}
?>
