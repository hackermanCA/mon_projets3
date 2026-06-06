<?php
require_once 'config.php';
requireLogin();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conseils Santé</title>
    <link rel="stylesheet" href="style 1.css">
</head>

<body>
<!-- Vérification de la connexion -->

       <div class="menu-burger" id="menuBurger">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <!-- Menu déroulant -->
        <div class="menu" id="menu">
            <a href="index.php">Accueil</a>
            <a href="about.php">À propos</a>
            <a href="services.php">Nos services</a>
            <?php if (isAdmin()): ?>
                <a href="admin.php">Administration</a>
            <?php endif; ?>
            <a href="logout.php">Déconnexion</a>
        </div>



    <header class="header-banner">
        <div class="container header-flex">
            <div>
                <h1 class="brand">Bien-être</h1>
            </div>
            <div class="menu-icon">
                <i class="ri-menu-line"></i>
            </div>
        </div>
    </header>

        <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="container hero-content">
            <h1 class="hero-title">Prenez soin de vous naturellement</h1>
            <p class="hero-desc">Découvrez des conseils simples et efficaces pour améliorer votre bien-être au quotidien. Notre approche holistique combine santé, alimentation, remèdes naturels et exercices physiques.</p>
             <button class="hero-btn" onclick="window.location.href='services.php'">Commencer maintenant</button>
        </div>
    </section>

    <script src="script.js"></script>
</body>

</html>