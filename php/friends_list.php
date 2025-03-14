<?php
require 'db.php';
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.html");
    exit;
}

$user_id = $_SESSION["user_id"];

// Récupérer la liste des amis de l'utilisateur
$stmt = $pdo->prepare("SELECT J.pseudo FROM AMI A JOIN JOUEUR J ON A.id_ami = J.id_joueur WHERE A.id_joueur = ? AND A.status = 'accepté'");
$stmt->execute([$user_id]);
$friends = $stmt->fetchAll();

echo "<h2>Liste de mes amis</h2>";
echo "<ul>";
foreach ($friends as $friend) {
    echo "<li>" . htmlspecialchars($friend['pseudo']) . "</li>";
}
echo "</ul>";
?>
