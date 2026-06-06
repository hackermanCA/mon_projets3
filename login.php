<?php
require_once 'config.php';

// Si déjà connecté, rediriger vers l'accueil
if (isLoggedIn()) {
    header('Location: index.php');
    exit;
}

// Traitement du formulaire de connexion
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($email) || empty($password)) {
        $error = 'Veuillez remplir tous les champs.';
    } else {
        $userId = authenticateUser($email, $password);
        if ($userId) {
            $_SESSION['user_id'] = $userId;
            header('Location: index.php');
            exit;
        } else {
            $error = 'Email ou mot de passe incorrect.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Connexion - Conseils Santé</title>
  <link rel="stylesheet" href="style3.css"/>
</head>
<body>
  <div class="container">
    <div class="login-box">
      <div class="form-section">
        <h2>Connexion</h2>

        <?php if ($error): ?>
            <div style="color: red; margin-bottom: 10px;"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form method="POST" action="login.php">
          <div class="input-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Entrez votre email" required value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" />
          </div>
          <div class="input-group">
            <label for="password">Mot de passe</label>
            <input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required />
          </div>

          <button type="submit" class="btn">Se connecter</button>
          <div class="links">
            <p>Pas de compte ? <a href="signup.php">S'inscrire</a></p>
            <p><a href="#">Mot de passe oublié ?</a></p>
          </div>
        </form>
      </div>
      <div class="welcome-section">
        <h1>Bienvenue !</h1>
        <p>Déjà membre ? Connectez-vous</p>
      </div>
    </div>
  </div>
</body>
</html>