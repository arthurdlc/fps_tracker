<?php
include '../config/database.php';
include '../config/functions.php';
include '../includes/session_check.php';

$stmt = $pdo->prepare("SELECT * FROM AMIS WHERE utilisateur_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$friends = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>Your Friends</h2>
    <ul>
        <?php foreach ($friends as $friend): ?>
            <li><?= $friend['friend_name'] ?> - <?= $friend['friend_email'] ?></li>
        <?php endforeach; ?>
    </ul>
</div>
<?php
include '../includes/footer.php';
?>
