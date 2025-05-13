<?php require 'includes/conn.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        .container { width: 300px; margin: 100px auto; }
        input { margin: 5px 0; padding: 5px; width: 100%; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if(isset($_SESSION['error'])): ?>
            <p style="color:red"><?= $_SESSION['error'] ?></p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>
        
        <form action="process/login_process.php" method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
</body>
</html>