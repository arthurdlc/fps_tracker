<?php
include '../config/database.php';
include '../config/functions.php';
include '../includes/admin_check.php';

$stmt = $pdo->prepare("SELECT * FROM REPORTS");
$stmt->execute();
$reports = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>View Reports</h2>
    <table>
        <tr>
            <th>Reported Player</th>
            <th>Reason</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($reports as $report): ?>
            <tr>
                <td><?= $report['reported_user_id'] ?></td>
                <td><?= $report['reason'] ?></td>
                <td><a href="admin_bans.php?report_id=<?= $report['id'] ?>">Take Action</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>
<?php
include '../includes/footer.php';
?>
