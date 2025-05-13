<?php
require 'includes/config.php';
require 'includes/auth.php';

if (!is_logged_in()) redirect('login.php');

$vehicles = $pdo->query("SELECT * FROM vehicles WHERE available = 1")->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Daftar Kendaraan</title>
    <style>
        .vehicle { border: 1px solid #ddd; padding: 10px; margin: 10px; }
    </style>
</head>
<body>
    <h1>Pilih Kendaraan</h1>
    <a href="dashboard.php">Dashboard</a> | <a href="logout.php">Logout</a>
    
    <?php foreach ($vehicles as $vehicle): ?>
    <div class="vehicle">
        <h3><?= htmlspecialchars($vehicle['name']) ?></h3>
        <p>Tipe: <?= $vehicle['type'] ?></p>
        <p>Harga/hari: Rp<?= number_format($vehicle['price'], 0) ?></p>
        <form method="POST" action="cart.php">
            <input type="hidden" name="vehicle_id" value="<?= $vehicle['id'] ?>">
            <label>Mulai: <input type="date" name="start_date" required></label>
            <label>Selesai: <input type="date" name="end_date" required></label>
            <button type="submit">Pesan</button>
        </form>
    </div>
    <?php endforeach; ?>
</body>
</html>