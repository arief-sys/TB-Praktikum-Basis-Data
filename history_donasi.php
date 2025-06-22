<?php
include 'db.php';

// Proses hapus histori donasi langsung di file ini
if (isset($_GET['hapus'])) {
    $hapus_id = (int)$_GET['hapus'];
    $conn->query("DELETE FROM histori_donasi WHERE id = $hapus_id");
    header("Location: history_donasi.php"); // redirect untuk mencegah refresh ulang
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Donasi</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>Riwayat Donasi</h2>
    <a href="index.php" class="btn btn-back">← Kembali ke Donasi</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Waktu</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $result = $conn->query("SELECT * FROM histori_donasi ORDER BY waktu DESC");
        while ($row = $result->fetch_assoc()):
        ?>
            <tr>
                <td><?= $row['id']; ?></td>
                <td><?= $row['waktu']; ?></td>
                <td><?= htmlspecialchars($row['keterangan']); ?></td>
                <td>
                    <a href="history_donasi.php?hapus=<?= $row['id']; ?>" class="btn btn-delete" onclick="return confirm('Yakin hapus riwayat ini?')">Hapus</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>