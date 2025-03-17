<?php
include '../config/database.php';
include '../config/functions.php';
include '../includes/admin_check.php';

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>Admin Panel</h2>
    <p>Welcome to the admin panel. Manage users and reports from here.</p>
    <ul>
        <li><a href="admin_users.php">Manage Users</a></li>
        <li><a href="admin_reports.php">View Reports</a></li>
        <li><a href="admin_bans.php">Manage Bans</a></li>
        <li><a href="admin_messages.php">View Messages</a></li>
    </ul>
</div>
<?php
include '../includes/footer.php';
?>
