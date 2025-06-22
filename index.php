<?php

session_start();
if (!isset($_SESSION['login_id'])) {
    header("Location: login.php");
    header("Location: register.php");

    exit;
}
include 'db.php';

$table_donasi = $conn->query("SELECT * FROM donasi ORDER BY tanggal_donasi DESC");
$table_pengeluaran = $conn->query("SELECT * FROM pengeluaran;");

?>

<!DOCTYPE html>
<html>


<h1>Selamat Datang di Sistem Donasi</h1>

<?php if (isset($_SESSION['login_id'])): ?>
    <p>Anda login sebagai <?php echo $_SESSION['role']; ?>: <strong><?php echo $_SESSION['username']; ?></strong></p>
    <?php if ($_SESSION['role'] == 'admin'): ?>
    <?php endif; ?>
    <br><a href="logout.php">Logout</a>
<?php else: ?>
    <a href="login.php">Login</a>
<?php endif; ?>



<head> 
    <title>Daftar Donasi</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color:rgb(255, 255, 255); }
        a.button { padding: 6px 12px; background: blue; color: white }
    </style>
</head>
<body>
    <h2>Daftar Donasi</h2>
    <a href="create_donasi.php" class="button">+ Tambah Donasi</a>
    <table>
        <tr>
            <th>ID</th><th>Nama</th><th>Email</th><th>Nominal</th><th>Pesan</th><th>Jenis</th><th>Tanggal</th><th>Aksi</th>
        </tr>
        <?php
        while ($row = $table_donasi->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= htmlspecialchars($row['nama_donatur']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td>Rp <?= number_format($row['nominal'],0,',','.') ?></td>
            <td><?= htmlspecialchars($row['pesan']) ?></td>
            <td><?= htmlspecialchars($row['jenis_donasi']) ?></td>
            <td><?= $row['tanggal_donasi'] ?></td>
            <td>
                <a href="edit_donasi.php?id=<?= $row['id'] ?>" class="button edit">Edit</a>
                <a href="delete_donasi.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')" class="button danger">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="history_donasi.php" class="button">Lihat Riwayat</a>
</body>



<head>
    <title>Daftar Pengeluaran</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        a.button { padding: 6px 12px; background: blue; color: white }
    </style>
</head>
<body>
    <h2>Daftar Pengeluaran</h2>
    <a href="create_pengeluaran.php" class="button">+ Tambah Pengeluaran</a>
    <table>
        <tr>
            <th>ID</th><th>Nominal</th><th>Pesan</th><th>Jenis</th><th>Tanggal</th><th>Aksi</th>
        </tr>
        <?php
        while ($row = $table_pengeluaran->fetch_assoc()):
        ?>
        <tr>
            <td><?= $row['id'] ?></td>
            <td>Rp <?= number_format($row['nominal'],0,',','.') ?></td>
            <td><?= htmlspecialchars($row['pesan']) ?></td>
            <td><?= htmlspecialchars($row['jenis_pengeluaran']) ?></td>
            <td><?= $row['tanggal_pengeluaran'] ?></td>
            <td>
                <a href="edit_pengeluaran.php?id=<?= $row['id'] ?>" class="button edit">Edit</a>
                <a href="delete_pengeluaran.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin?')" class="button danger">Hapus</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="history_pengeluaran.php" class="button">Lihat Riwayat</a>
</body>




</html>