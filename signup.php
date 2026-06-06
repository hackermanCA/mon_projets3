<?php
require_once 'config.php';

// Si déjà connecté, rediriger vers l'accueil
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Traitement du formulaire d'inscription
$error = '';
$success = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    if (empty($email) || empty($password) || empty($confirm_password)) {
        $error = 'Veuillez remplir tous les champs.';
    } elseif ($password !== $confirm_password) {
        $error = 'Les mots de passe ne correspondent pas.';
    } elseif (strlen($password) < 6) {
        $error = 'Le mot de passe doit contenir au moins 6 caractères.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Adresse email invalide.';
    } else {
        $userId = createUser($email, $password);
        if ($userId) {
            $success = 'Inscription réussie ! Vous pouvez maintenant vous connecter.';
        } else {
            $error = 'Cette adresse email est déjà utilisée.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Conseils Santé</title>
    <link rel="stylesheet" href="style3.css">
</head>

<body>

    <div class="container">
        <h2>Créer un compte</h2>

        <?php if ($error): ?>
            <div style="color: red; margin-bottom: 10px;"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div style="color: green; margin-bottom: 10px;"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>

        <form method="POST" action="signup.php">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Entrez votre email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
            </div>

            <div class="input-group">
                <label for="password">Mot de passe</label>
                <input type="password" id="password" name="password" placeholder="Entrez un mot de passe" required>
            </div>

            <div class="input-group">
                <label for="confirm_password">Confirmer le mot de passe</label>
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirmez votre mot de passe" required>
            </div>

            <button type="submit" class="btn">S'inscrire</button>
            <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
        </form>
    </div>

</body>

</html>