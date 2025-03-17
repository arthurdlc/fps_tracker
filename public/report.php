<?php
include '../config/database.php';
include '../config/functions.php';
include '../includes/session_check.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $report_reason = $_POST['reason'];
    $reported_user_id = $_POST['reported_user_id'];

    $stmt = $pdo->prepare("INSERT INTO REPORTS (user_id, reported_user_id, reason) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $reported_user_id, $report_reason]);

    echo "Report submitted.";
}

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>Report a Player</h2>
    <form method="POST">
        <select name="reason" required>
            <option value="Harassment">Harassment</option>
            <option value="Cheating">Cheating</option>
            <option value="Toxic Behavior">Toxic Behavior</option>
        </select>
        <input type="text" name="reported_user_id" class="input-field" placeholder="Player ID" required>
        <button type="submit" class="btn-submit">Submit Report</button>
    </form>
</div>
<?php
include '../includes/footer.php';
?>
