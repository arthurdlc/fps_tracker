<?php
include '../config/database.php';
include '../config/functions.php';
include '../includes/session_check.php';

$stmt = $pdo->prepare("SELECT * FROM STATISTIQUES_JOUEUR WHERE utilisateur_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$stats = $stmt->fetch(PDO::FETCH_ASSOC);

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>Your Dashboard</h2>
    <table>
        <tr>
            <td>Games Played</td>
            <td><?= $stats['parties_jouees'] ?></td>
        </tr>
        <tr>
            <td>KD Ratio</td>
            <td><?= $stats['ratio_kd'] ?></td>
        </tr>
        <tr>
            <td>Headshots</td>
            <td><?= $stats['tirs_tete'] ?></td>
        </tr>
        <tr>
            <td>Time Played</td>
            <td><?= gmdate("H:i:s", $stats['temps_joue_secondes']) ?></td>
        </tr>
    </table>
</div>
<?php
include '../includes/footer.php';
?>
