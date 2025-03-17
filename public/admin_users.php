<?php
include '../config/database.php';
include '../config/functions.php';
include '../includes/admin_check.php';

$stmt = $pdo->prepare("SELECT * FROM UTILISATEUR");
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>Manage Users</h2>
    <table>
        <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['pseudo'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><a href="admin_bans.php?user_id=<?= $user['id'] ?>">Ban</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php
include '../includes/footer.php';
?>
