<?php
include 'db.php';
$id = $_GET['id'];
$donasi = $conn->query("SELECT * FROM donasi WHERE id=$id")->fetch_assoc();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_donatur'];
    $email = $_POST['email'];
    $nominal = $_POST['nominal'];
    $pesan = $_POST['pesan'];
    $jenis = $_POST['jenis_donasi'];

    $conn->query("UPDATE donasi SET nama_donatur='$nama', email='$email', nominal='$nominal', pesan='$pesan', jenis_donasi='$jenis' WHERE id=$id");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Donasi</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        label { display: block; margin-top: 10px; }
        input, textarea, select { width: 30%; padding: 8px; margin-top: 4px; }
        button { margin-top: 10px; padding: 8px 12px; }
    </style>
</head>
<body>
    <h2>Edit Donasi</h2>
    <form method="post">
        <label>Nama Donatur</label>
        <input type="text" name="nama_donatur" value="<?= $donasi['nama_donatur'] ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= $donasi['email'] ?>">

        <label>Nominal Donasi</label>
        <input type="number" name="nominal" value="<?= $donasi['nominal'] ?>" required>

        <label>Pesan</label>
        <textarea name="pesan"><?= $donasi['pesan'] ?></textarea>

        <label>Jenis Donasi</label>
        <select name="jenis_donasi">
            <option value="Donasi Kesehatan" <?= $donasi['jenis_donasi']=='Donasi Kesehatan'?'selected':'' ?>>Donasi Kesehatan</option>
            <option value="Donasi Bencana Alam" <?= $donasi['jenis_donasi']=='Donasi Bencana Alam'?'selected':'' ?>>Donasi Bencana Alam</option>
            <option value="Donasi Pembangunan" <?= $donasi['jenis_donasi']=='Donasi Pembangunan'?'selected':'' ?>>Donasi Pembangunan</option>
        </select>

        <button type="submit">Update</button>
        <a href="index.php">Batal</a>
    </form>
</body>
</html>
