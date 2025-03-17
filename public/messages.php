<?php
include '../config/database.php';
include '../config/functions.php';
include '../includes/session_check.php';

$stmt = $pdo->prepare("SELECT * FROM MESSAGE WHERE expediteur_id = ? OR destinataire_id = ?");
$stmt->execute([$_SESSION['user_id'], $_SESSION['user_id']]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>Your Messages</h2>
    <table>
        <tr>
            <th>Sender</th>
            <th>Message</th>
            <th>Date</th>
        </tr>
        <?php foreach ($messages as $message): ?>
            <tr>
                <td><?= ($message['expediteur_id'] == $_SESSION['user_id']) ? 'You' : 'Player ' . $message['expediteur_id'] ?></td>
                <td><?= $message['contenu'] ?></td>
                <td><?= $message['date_envoi'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php
include '../includes/footer.php';
?>
