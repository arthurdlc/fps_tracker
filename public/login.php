<?php
include '../config/database.php';
include '../config/functions.php';

if (isLoggedIn()) {
    redirect('dashboard.php');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM UTILISATEUR WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['mot_de_passe'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email'];
        redirect('dashboard.php');
    } else {
        $error = "Invalid email or password.";
    }
}

include '../includes/header.php';
include '../includes/navbar.php';
?>
<div class="container">
    <h2>Login</h2>
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>
    <form method="POST">
        <input type="email" name="email" class="input-field" placeholder="Email" required>
        <input type="password" name="password" class="input-field" placeholder="Password" required>
        <button type="submit" class="btn-submit">Login</button>
    </form>
    <p><a href="register.php">Don't have an account? Register here</a></p>
</div>
<?php
include '../includes/footer.php';
?>
