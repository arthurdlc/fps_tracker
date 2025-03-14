<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION["user_id"])) {
    $friend_id = $_POST["friend_id"];
    $user_id = $_SESSION["user_id"];

    // Vérifier si la demande existe déjà
    $stmt = $pdo->prepare("SELECT * FROM AMI WHERE id_joueur = ? AND id_ami = ?");
    $stmt->execute([$user_id, $friend_id]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(["status" => "error", "message" => "Demande d'ami déjà envoyée."]);
        exit;
    }

    // Ajouter la demande d'ami
    $stmt = $pdo->prepare("INSERT INTO AMI (id_joueur, id_ami, status) VALUES (?, ?, 'en attente')");
    if ($stmt->execute([$user_id, $friend_id])) {
        echo json_encode(["status" => "success", "message" => "Demande d'ami envoyée."]);
    } else {
        echo json_encode(["status" => "error", "message" => "Erreur lors de l'envoi de la demande."]);
    }
}
?>
