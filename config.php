<?php
session_start();

// Configuration de la base de données simulée (fichier JSON)
define('USERS_FILE', __DIR__ . '/users.json');

// Fonction pour charger les utilisateurs
function loadUsers() {
    if (file_exists(USERS_FILE)) {
        $data = file_get_contents(USERS_FILE);
        $result = json_decode($data, true);
        if ($result) {
            return $result;
        } else {
            return array();
        }
    }
    return array();
}

// Fonction pour sauvegarder les utilisateurs
function saveUsers($users) {
    file_put_contents(USERS_FILE, json_encode($users, JSON_PRETTY_PRINT));
}

// Fonction pour vérifier si l'utilisateur est connecté
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Fonction pour rediriger si non connecté
function requireLogin() {
    if (!isLoggedIn()) {
        header('Location: login.php');
        exit;
    }
}

// Fonction pour obtenir l'utilisateur actuel
function getCurrentUser() {
    if (isLoggedIn()) {
        $users = loadUsers();
        if (isset($users[$_SESSION['user_id']])) {
            return $users[$_SESSION['user_id']];
        } else {
            return null;
        }
    }
    return null;
}

// Fonction pour vérifier si l'utilisateur est admin
function isAdmin() {
    $user = getCurrentUser();
    return $user && $user['email'] === 'admin@example.com';
}

// Fonction pour vérifier les identifiants
function authenticateUser($email, $password) {
    $users = loadUsers();
    foreach ($users as $id => $user) {
        if ($user['email'] === $email && password_verify($password, $user['password'])) {
            return $id;
        }
    }
    return false;
}

// Fonction pour créer un nouvel utilisateur
function createUser($email, $password) {
    $users = loadUsers();

    // Vérifier si l'email existe déjà
    foreach ($users as $user) {
        if ($user['email'] === $email) {
            return false;
        }
    }

    $userId = uniqid();
    $users[$userId] = array(
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT),
        'created_at' => date('Y-m-d H:i:s')
    );

    saveUsers($users);
    return $userId;
}
?>