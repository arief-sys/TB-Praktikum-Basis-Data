<?php
require 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $nama     = $_POST['nama_lengkap'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO user (username, password, nama_lengkap) VALUES (?, ?, ?)";
    $stmt  = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'sss', $username, $password, $nama);

    if (mysqli_stmt_execute($stmt)) {
        echo "User berhasil didaftarkan!";
    } else {
        echo "Gagal daftar user: " . mysqli_error($conn);
    }
}
?>

<h2>Daftar User</h2>
<form method="post">
    <label>Nama Lengkap:</label><br>
    <input type="text" name="nama_lengkap" required><br><br>

    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Daftar User</button>
</form>
