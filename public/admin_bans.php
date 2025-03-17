<?php
include '../config/database.php';
include '../config/functions.php';
include '../includes/admin_check.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
    // Add ban logic
}

if (isset($_GET['report_id'])) {
    $report_id = $_GET['report_id'];
    // Take action on report (ban or warning)
}

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>Manage Bans</h2>
    <form method="POST">
        <label for="ban_duration">Ban Duration:</label>
        <select name="ban_duration" id="ban_duration">
            <option value="1">1 Day</option>
            <option value="7">1 Week</option>
            <option value="30">1 Month</option>
        </select>
        <button type="submit" class="btn-submit">Ban User</button>
    </form>
</div>
<?php
include '../includes/footer.php';
?>
