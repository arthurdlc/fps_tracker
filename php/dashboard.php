<?php
// Inclure la connexion à la base de données
require 'db.php';

// Vérifier si l'utilisateur est connecté
session_start();
if (!isset($_SESSION['id_joueur'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: login.html');
    exit;
}

// Récupérer les informations de l'utilisateur connecté
$id_joueur = $_SESSION['id_joueur'];

// Récupérer les statistiques du joueur
$stmt = $pdo->prepare("SELECT * FROM STATISTIQUES WHERE id_joueur = ?");
$stmt->execute([$id_joueur]);
$statistiques = $stmt->fetch(PDO::FETCH_ASSOC);

// Récupérer les informations de l'utilisateur (nom, prénom, pseudo)
$stmt_user = $pdo->prepare("SELECT * FROM JOUEUR WHERE id_joueur = ?");
$stmt_user->execute([$id_joueur]);
$utilisateur = $stmt_user->fetch(PDO::FETCH_ASSOC);

// Récupérer les amis de l'utilisateur
$stmt_amis = $pdo->prepare("SELECT J.pseudo FROM AMI A JOIN JOUEUR J ON A.id_ami = J.id_joueur WHERE A.id_joueur = ? AND A.status = 'accepté'");
$stmt_amis->execute([$id_joueur]);
$amis = $stmt_amis->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les demandes d'amis en attente
$stmt_demandes = $pdo->prepare("SELECT J.pseudo FROM AMI A JOIN JOUEUR J ON A.id_joueur = J.id_joueur WHERE A.id_ami = ? AND A.status = 'en attente'");
$stmt_demandes->execute([$id_joueur]);
$demandes = $stmt_demandes->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - FPS Tracker</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h2>Bienvenue, <?php echo htmlspecialchars($utilisateur['pseudo']); ?> !</h2>
    
    <div>
        <h3>Vos statistiques de jeu</h3>
        <table>
            <tr>
                <th>Parties jouées</th>
                <td><?php echo $statistiques['parties_jouees']; ?></td>
            </tr>
            <tr>
                <th>K/D/A</th>
                <td><?php echo number_format($statistiques['kda'], 2); ?></td>
            </tr>
            <tr>
                <th>Tirs dans la tête</th>
                <td><?php echo $statistiques['tirs_dans_tete']; ?></td>
            </tr>
            <tr>
                <th>Temps joué (en heures)</th>
                <td><?php echo number_format($statistiques['temps_joue'] / 3600, 2); ?></td>
            </tr>
        </table>
    </div>

    <div>
        <h3>Vos amis</h3>
        <ul>
            <?php foreach ($amis as $ami): ?>
                <li><?php echo htmlspecialchars($ami['pseudo']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div>
        <h3>Demandes d'amis en attente</h3>
        <ul>
            <?php foreach ($demandes as $demande): ?>
                <li><?php echo htmlspecialchars($demande['pseudo']); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div>
        <h3>Actions</h3>
        <a href="logout.php">Se déconnecter</a>
    </div>

</body>
</html>
