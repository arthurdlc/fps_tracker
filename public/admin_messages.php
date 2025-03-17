<?php
include '../config/database.php';
include '../config/functions.php';
include '../includes/admin_check.php';

$stmt = $pdo->prepare("SELECT * FROM MESSAGES");
$stmt->execute();
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>View Messages</h2>
    <table>
        <tr>
            <th>Sender</th>
            <th>Message</th>
        </tr>
        <?php foreach ($messages as $message): ?>
            <tr>
                <td><?= $message['sender_id'] ?></td>
                <td><?= $message['content'] ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php
include '../includes/footer.php';
?>
