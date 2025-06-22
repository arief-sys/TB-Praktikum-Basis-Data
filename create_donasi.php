<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama = $_POST['nama_donatur'];
    $email = $_POST['email'];
    $nominal = $_POST['nominal'];
    $pesan = $_POST['pesan'];
    $jenis = $_POST['jenis_donasi'];

    $conn->query("INSERT INTO donasi (nama_donatur, email, nominal, pesan, jenis_donasi) VALUES ('$nama', '$email', '$nominal', '$pesan', '$jenis')");
    $id_donasi = $conn->insert_id;
    $conn->query("INSERT INTO histori_donasi (id_donasi, keterangan) VALUES ($id_donasi, 'Donasi masuk dari $nama sebesar Rp $nominal')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Donasi</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        label { display: block; margin-top: 10px; }
        input, textarea, select { width: 30%; padding: 8px; margin-top: 4px; }
        button { margin-top: 10px; padding: 8px 12px; }
    </style>
</head>
<body>
    <h2>Form Donasi</h2>
    <form method="post">
        <label>Nama Donatur</label>
        <input type="text" name="nama_donatur" required>

        <label>Email</label>
        <input type="email" name="email">

        <label>Nominal Donasi</label>
        <input type="number" name="nominal" step="1000" required>

        <label>Pesan</label>
        <textarea name="pesan"></textarea>

        <label>Jenis Donasi</label>
        <select name="jenis_donasi">
            <option value="Donasi Kesehatan">Donasi Kesehatan</option>
            <option value="Donasi Bencana Alam">Donasi Bencana Alam</option>
            <option value="Donasi Pembangunan">Donasi Pembangunan</option>
        </select>

        <button type="submit">Kirim Donasi</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>
