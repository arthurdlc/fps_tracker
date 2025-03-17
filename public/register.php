<?php
include '../config/database.php';
include '../config/functions.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO UTILISATEUR (nom, prenom, pseudo, email, mot_de_passe) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $pseudo, $email, $password_hash]);

    redirect('login.php');
}

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>Create an Account</h2>
    <form method="POST">
        <input type="text" name="nom" class="input-field" placeholder="First Name" required>
        <input type="text" name="prenom" class="input-field" placeholder="Last Name" required>
        <input type="text" name="pseudo" class="input-field" placeholder="Username" required>
        <input type="email" name="email" class="input-field" placeholder="Email" required>
        <input type="password" name="password" class="input-field" placeholder="Password" required>
        <button type="submit" class="btn-submit">Register</button>
    </form>
    <p><a href="login.php">Already have an account? Login here</a></p>
</div>
<?php
include '../includes/footer.php';
?>
