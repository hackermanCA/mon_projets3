<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category = $_POST['category'] ?? '';

    if (in_array($category, ['sante', 'alimentation', 'remedes', 'exercices'])) {
        $statsFile = __DIR__ . '/stats.json';
        $stats = file_exists($statsFile) ? json_decode(file_get_contents($statsFile), true) : [
            'visitors' => 0,
            'sante' => 0,
            'alimentation' => 0,
            'remedes' => 0,
            'exercices' => 0
        ];

        $stats[$category]++;
        file_put_contents($statsFile, json_encode($stats));

        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => 'Invalid category']);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid method']);
}
?>