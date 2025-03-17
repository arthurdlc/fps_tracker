<?php
include '../config/database.php';
include '../config/functions.php';
include '../includes/session_check.php';

$stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>Your Profile</h2>
    <p>Username: <?= $user['pseudo'] ?></p>
    <p>Email: <?= $user['email'] ?></p>
    <p>Full Name: <?= $user['prenom'] ?> <?= $user['nom'] ?></p>
    <p><a href="edit_profile.php">Edit Profile</a></p>
</div>
<?php
include '../includes/footer.php';
?>
