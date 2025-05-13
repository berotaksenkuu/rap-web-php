<?php
session_start();
include "service/database.php";
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);


$register_message ="";

if (isset($_SESSION["is_login"])) {
    header("Location: dashboard.php");
    exit;
}

if(isset($_POST["register"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $hashed_password = hash("sha256", $password);

    try{//input data ke dalam tabel users
    $sql = "INSERT INTO users (username, password) VALUES ('$username','$hashed_password')";
        
    if($db->query($sql)){
        $register_message = "Daftar akun berhasil, silahkan login";
    }else{
        $register_message = "Daftar akun gagal, silahkan coba lagi";
    }
    }catch(mysqli_sql_exception ){
        $register_message = "username telah digunakan";
    }
    $db->close();
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include"layout/header.html" ?>

    <h3>DAFTAR AKUN</h3>
    <i><?= $register_message ?></i>
    <form action="register.php" method="POST">
        <input type="text" placeholder="username" name="username"/>
        <input type="password" placeholder="password" name="password"/>
        <button type="submit" name="register">daftar sekarang</button>
    </form>
    <?php include"layout/footer.html" ?>
</body>
</html>