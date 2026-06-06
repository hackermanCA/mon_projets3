<?php
require_once 'config.php';
requireLogin();

// Charger les statistiques depuis un fichier JSON
$statsFile = __DIR__ . '/stats.json';
$stats = file_exists($statsFile) ? json_decode(file_get_contents($statsFile), true) : [
    'visitors' => 0,
    'sante' => 0,
    'alimentation' => 0,
    'remedes' => 0,
    'exercices' => 0
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Tableau de bord</title>
    <link rel="stylesheet" href="style 1.css">
    <link rel="stylesheet" href="admin.css">
    <style>
      .charts-container { display: flex; flex-wrap: wrap; gap: 32px; justify-content: center; margin-top: 2em; }
      .chart-box { background: #fff; border-radius: 12px; box-shadow: 0 2px 8px #0001; padding: 2em; width: 350px; }
      @media (max-width: 800px) { .charts-container { flex-direction: column; align-items: center; } .chart-box { width: 100%; } }
    </style>
</head>
<body>
    <div class="admin-dashboard">
        <h2>Tableau de bord administrateur</h2>
        <div class="charts-container">
            <div class="chart-box">
                <h3 style="text-align:center;">Consultations par catégorie</h3>
                <canvas id="barChart" width="320" height="220"></canvas>
            </div>
            <div class="chart-box">
                <h3 style="text-align:center;">Répartition des consultations</h3>
                <canvas id="pieChart" width="320" height="220"></canvas>
            </div>
        </div>
        <table class="stats-table">
            <tr><th>Statistique</th><th>Valeur</th></tr>
            <tr><td>Nombre total de visiteurs</td><td id="visitorsCount"><?php echo $stats['visitors']; ?></td></tr>
            <tr><td>Nombre de consultations Santé</td><td id="santeCount"><?php echo $stats['sante']; ?></td></tr>
            <tr><td>Nombre de consultations Alimentation</td><td id="alimentationCount"><?php echo $stats['alimentation']; ?></td></tr>
            <tr><td>Nombre de consultations Remèdes</td><td id="remedesCount"><?php echo $stats['remedes']; ?></td></tr>
            <tr><td>Nombre de consultations Exercices</td><td id="exercicesCount"><?php echo $stats['exercices']; ?></td></tr>
        </table>
        <button onclick="resetStats()">Réinitialiser les statistiques</button>
        <br><br>
        <a href="index.php">Retour à l'accueil</a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="admin.js"></script>
</body>
</html>