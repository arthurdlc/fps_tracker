<?php
if (isset($_SESSION['ban_expiry']) && time() < $_SESSION['ban_expiry']) {
    $remaining_time = $_SESSION['ban_expiry'] - time();
    echo "<div class='toaster'>You are banned. You will be able to access your account again in " . gmdate("H:i:s", $remaining_time) . ".</div>";
    exit;
}
?>
