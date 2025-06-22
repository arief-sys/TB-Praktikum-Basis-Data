<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nominal = $_POST['nominal'];
    $pesan = $_POST['pesan'];
    $jenis = $_POST['jenis_pengeluaran'];

    $conn->query("INSERT INTO pengeluaran (nominal, pesan, jenis_pengeluaran) VALUES ('$nominal', '$pesan', '$jenis')");
    $id_pengeluaran = $conn->insert_id;
    $conn->query("INSERT INTO histori_pengeluaran (id_pengeluaran, keterangan) VALUES ($id_pengeluaran, '$jenis sebesar Rp $nominal')");
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Pengeluaran</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        label { display: block; margin-top: 10px; }
        input, textarea, select { width: 30%; padding: 8px; margin-top: 4px; }
        button { margin-top: 10px; padding: 8px 12px; }
    </style>
</head>
<body>
    <h2>Form Pengeluaran</h2>
    <form method="post">
        <label>Nominal Pengeluaran</label>
        <input type="number" name="nominal" step="1000" required>

        <label>Pesan</label>
        <textarea name="pesan"></textarea>

        <label>Jenis Pengeluaran</label>
        <select name="jenis_pengeluaran">
            <option value="Pengeluaran Kesehatan">Pengeluaran Kesehatan</option>
            <option value="Pengeluaran Bencana Alam">Pengeluaran Bencana Alam</option>
            <option value="Pengeluaran Pembangunan">Pengeluaran Pembangunan</option>
        </select>

        <button type="submit">Kirim Pengeluaran</button>
        <a href="index.php">Kembali</a>
    </form>
</body>
</html>
