<?php
include 'db.php';
$id = $_GET['id'];
$pengeluaran = $conn->query("SELECT * FROM pengeluaran WHERE id=$id")->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nominal = $_POST['nominal'];
    $pesan = $_POST['pesan'];
    $jenis = $_POST['jenis_pengeluaran'];

    $conn->query("UPDATE pengeluaran SET nominal='$nominal', pesan='$pesan', jenis_pengeluaran='$jenis' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Pengeluaran</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        label { display: block; margin-top: 10px; }
        input, textarea, select { width: 30%; padding: 8px; margin-top: 4px; }
        button { margin-top: 10px; padding: 8px 12px; }
    </style>
</head>
<body>
    <h2>Edit Pengeluaran</h2>
    <form method="post">
        <label>Nominal Pengeluaran</label>
        <input type="number" name="nominal" value="<?= $pengeluaran['nominal'] ?>" required>

        <label>Pesan</label>
        <textarea name="pesan"><?= $pengeluaran['pesan'] ?></textarea>

        <label>Jenis Pengeluaran</label>
        <select name="jenis_pengeluaran">
            <option value="Pengeluaran Kesehatan" <?= $pengeluaran['jenis_pengeluaran']=='Pengeluaran Kesehatan'?'selected':'' ?>>Pengeluaran Kesehatan</option>
            <option value="Pengeluaran Bencana Alam" <?= $pengeluaran['jenis_pengeluaran']=='Pengeluaran Bencana Alam'?'selected':'' ?>>Pengeluaran Bencana Alam</option>
            <option value="Pengeluaran Pembangunan" <?= $pengeluaran['jenis_pengeluaran']=='Pengeluaran Pembangunan'?'selected':'' ?>>Pengeluaran Pembangunan</option>
        </select>

        <button type="submit">Update</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>
