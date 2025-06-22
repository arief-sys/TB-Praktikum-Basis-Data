<?php
session_start();
require 'db.php';

if (isset($_POST['register'])) {
    $role     = $_POST['role_reg'];
    $username = $_POST['username_reg'];
    $password = password_hash($_POST['password_reg'], PASSWORD_DEFAULT);
    $nama     = $_POST['nama_lengkap_reg'] ?? null;

    if ($role == 'admin') {
        $query = "INSERT INTO admin (username, password) VALUES (?, ?)";
        $stmt  = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'ss', $username, $password);
    } else {
        $query = "INSERT INTO user (username, password, nama_lengkap) VALUES (?, ?, ?)";
        $stmt  = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, 'sss', $username, $password, $nama);
    }

    if (mysqli_stmt_execute($stmt)) {
        $register_success = "Registrasi berhasil! Silakan login.";
    } else {
        $register_error = "Registrasi gagal: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Selamat Datang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
        }

        .btn {
            border: 1px solid navy;
            padding: 10px 20px;
            margin: 20px;
            display: inline-block;
            text-decoration: none;
            color: black;
        }

        .btn:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>


<head>
    <title>Register</title>
</head>
<body>

<h2>Register</h2>
<?php if (isset($register_success)) echo "<p style='color:green;'>$register_success</p>"; ?>
<?php if (isset($register_error)) echo "<p style='color:red;'>$register_error</p>"; ?>

<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username_reg" required><br>

    <label>Password:</label><br>
    <input type="password" name="password_reg" required><br>

    <label>Nama Lengkap (hanya untuk user):</label><br>
    <input type="text" name="nama_lengkap_reg"><br>

    <label>Daftar Sebagai:</label><br>
    <select name="role_reg" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit" name="register">Register</button>
</form>

<p>Sudah punya akun? <a href="login.php">Login di sini</a></p>

</body>
</html>
