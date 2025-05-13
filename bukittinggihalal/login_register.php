<?php

session_start();
require_once 'conn.php';

if (isset($_POST['register'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email telah pernah digunakan';
        $_SESSION['active_form'] = 'register';
    } else {
        $conn->query("INSERT INTO users(nama, email, password, role) VALUES ('$nama','$email','$password','$role')");
    }
    header("Location: index.php");
    exit();
}

if (isset($_POST["login"])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn ->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if(password_verify($password, $user["password"])){
            $_SESSION["nama"] = $user["nama"];
            $_SESSION["email"] = $user["email"];

            if ($user['role'] === 'admin'){
                header("Location: admin_page.php");
            } else {
                header("Location: user_page.php");
            }
            exit();
        }
    }
    $_SESSION['login_error'] = 'Password atau Email Salah';
    $_SESSION['active_form'] = 'login';
    header("Location: index.php");
    exit();
}
?>