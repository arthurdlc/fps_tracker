<?php
// Inclure la connexion à la base de données
require 'db.php';

// Vérifier si les données du formulaire sont envoyées
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les informations de l'utilisateur
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT); // Hachage du mot de passe

    // Vérifier si l'email existe déjà dans la base de données
    $stmt_email = $pdo->prepare("SELECT * FROM JOUEUR WHERE email = ?");
    $stmt_email->execute([$email]);
    $email_exist = $stmt_email->fetch(PDO::FETCH_ASSOC);

    if ($email_exist) {
        // Si l'email existe déjà, afficher un message d'erreur
        echo json_encode(["status" => "error", "message" => "Cet email est déjà utilisé."]);
        exit; // Arrêter l'exécution du script ici
    }

    // Vérifier si le pseudo existe déjà dans la base de données
    $stmt_pseudo = $pdo->prepare("SELECT * FROM JOUEUR WHERE pseudo = ?");
    $stmt_pseudo->execute([$pseudo]);
    $pseudo_exist = $stmt_pseudo->fetch(PDO::FETCH_ASSOC);

    if ($pseudo_exist) {
        // Si le pseudo existe déjà, afficher un message d'erreur
        echo json_encode(["status" => "error", "message" => "Ce pseudo est déjà pris."]);
        exit; // Arrêter l'exécution du script ici
    }

    // Préparer la requête pour insérer un nouvel utilisateur dans la base de données
    $stmt = $pdo->prepare("INSERT INTO JOUEUR (nom, prenom, pseudo, email, mot_de_passe) VALUES (?, ?, ?, ?, ?)");

    try {
        // Exécuter la requête pour insérer l'utilisateur
        $stmt->execute([$nom, $prenom, $pseudo, $email, $mot_de_passe]);
        
        // Message de succès
        echo json_encode(["status" => "success", "message" => "Compte créé avec succès."]);

        // Rediriger vers la page de connexion après la création du compte
        header("Location: login.html");
        exit; // Assurez-vous que le script s'arrête ici après la redirection

    } catch (PDOException $e) {
        // Gérer les erreurs si quelque chose se passe mal
        echo json_encode(["status" => "error", "message" => "Erreur lors de la création du compte: " . $e->getMessage()]);
    }
}
?>