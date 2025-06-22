<?php
require 'db.php';

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO admin (username, password) VALUES (?, ?)";
    $stmt  = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'ss', $username, $password);

    if (mysqli_stmt_execute($stmt)) {
        echo "Admin berhasil didaftarkan!";
    } else {
        echo "Gagal daftar admin: " . mysqli_error($conn);
    }
}
?>

<h2>Daftar Admin</h2>
<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br><br>

    <button type="submit" name="register">Daftar Admin</button>
</form>
