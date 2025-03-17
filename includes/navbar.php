<?php
// Inclure le fichier functions.php pour avoir accès à la fonction isLoggedIn() et isAdmin()
include '../config/functions.php';
?>

<nav>
    <ul>
        <li><a href="index.php">Home</a></li>
        <?php if (isLoggedIn()): ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="messages.php">Messages</a></li>
            <li><a href="friends.php">Friends</a></li>
            
            <?php if (isAdmin()): ?>
                <li><a href="admin_panel.php">Admin Panel</a></li>
                <li><a href="admin_users.php">Manage Users</a></li>
                <li><a href="admin_reports.php">Reports</a></li>
                <li><a href="admin_bans.php">Bans</a></li>
                <li><a href="admin_messages.php">Admin Messages</a></li>
            <?php endif; ?>
            
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
        <?php endif; ?>
    </ul>
</nav>
