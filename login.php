<?php
session_start();
require 'db.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role     = $_POST['role'];

    $table = ($role == 'admin') ? 'admin' : 'user';
    $query = "SELECT * FROM $table WHERE username = ?";
    $stmt  = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['login_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['role']     = $role;

            if ($role == 'admin') {
                header("Location: dashboard_admin.php");
            } else {
                header("Location: dashboard_user.php");
            }
            header("Location: index.php");
            exit;
        } else {
            $login_error = "Password salah!";
        }
    } else {
        $login_error = "Username tidak ditemukan!";
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
    <h3>SELAMAT DATANG DI SISTEM DONASI</h3>
</body>


<head>
    <title>Login</title>
</head>
<body>

<h2>Login</h2>
<?php if (isset($login_error)) echo "<p style='color:red;'>$login_error</p>"; ?>

<form method="post">
    <label>Username:</label><br>
    <input type="text" name="username" required><br>

    <label>Password:</label><br>
    <input type="password" name="password" required><br>

    <label>Masuk Sebagai:</label><br>
    <select name="role" required>
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit" name="login">Login</button>
</form>

<p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>

</body>
</html>
