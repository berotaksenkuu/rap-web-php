<?php
require '../includes/config.php';
require '../includes/auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$_POST['email']]);
    $user = $stmt->fetch();

    if ($user && password_verify($_POST['password'], $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        redirect('../vehicles.php');
    } else {
        $_SESSION['error'] = "Email/password salah";
        redirect('../login.php');
    }
}
?>