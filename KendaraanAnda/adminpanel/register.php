<?php
session_start();
include "../koneksi.php"; // pastikan koneksi sudah benar

if (isset($_POST['registerbtn'])) {
    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    // Cek apakah password dan confirm password sama
    if ($password !== $confirm_password) {
        echo '<div class="alert alert-danger" role="alert">Password dan Confirm Password tidak cocok</div>';
    } else {
        // Hash password menggunakan password_hash
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Cek apakah username sudah ada di database
        $query = mysqli_query($koneksi, "SELECT * FROM admin WHERE username = '$username'");
        if (mysqli_num_rows($query) > 0) {
            echo '<div class="alert alert-danger" role="alert">Username sudah digunakan</div>';
        } else {
            // Simpan data pengguna baru ke database
            $query = "INSERT INTO admin (username, password) VALUES ('$username', '$hashed_password')";
            if (mysqli_query($koneksi, $query)) {
                echo '<div class="alert alert-success" role="alert">Registrasi berhasil! Anda dapat login sekarang.</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Gagal mendaftar. Coba lagi.</div>';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
</head>

<body>
    <div class="main d-flex flex-column justify-content-center align-items-center">
        <div class="register-box p-5 shadow">
            <form action="" method="post">
                <div>
                    <label for="username">Username</label>
                    <input type="text" class="form-control" name="username" id="username" required>
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" required>
                </div>
                <div>
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" required>
                </div>
                <div>
                    <button class="btn btn-success form-control mt-3" type="submit" name="registerbtn">Register</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>