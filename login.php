<?php
session_start();
require "functions.php";


if (isset($_SESSION["role"])) {
  $role = $_SESSION["role"];
  if ($role == "Admin") {
    header("Location: admin/home.php");
  } else {
    header("Location: user/lapangan.php");
  }
}

if (isset($_POST["login"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];

  $cariadmin = query("SELECT * FROM admin_212279 WHERE 212279_email = '$username' AND 212279_password = '$password'");
  $cariuser = query("SELECT * FROM user_212279 WHERE 212279_email = '$username' AND 212279_password = '$password'");

  if ($cariadmin) {
    // set session
    $_SESSION['username'] = $cariadmin[0]['212279_nama'];
    $_SESSION['role'] = "Admin";
    header("Location: admin/admin.php");
  } else if ($cariuser) {
    // set session
    $_SESSION['email'] = $cariuser[0]['212279_email'];
    $_SESSION['id_user'] = $cariuser[0]['212279_id_user'];
    $_SESSION['role'] = "User";
    header("Location: user/lapangan.php");
  } else {
    echo "<div class='alert alert-warning'>Username atau Password salah</div>
    <meta http-equiv='refresh' content='2'>";
  }
}


?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="utf-8">
  <title>Login My futsal Sport Center</title>
  
  <link rel="stylesheet" href="style.css">
</head>

<body class="login">
  <div class="center">
    <h1>Login</h1>
    <hr>
    <center><p>Selamat datang di My Futsal Center</p></center>
    <form method="POST">
      <div class="txt_field">
        <input type="email" name="username" required>
        <span></span>
        <label>Email</label>
      </div>
      <div class="txt_field">
        <input type="password" name="password" required>
        <span></span>
        <label>Password</label>
      </div>
      <div class="pass">Lupa Sandi?</div>
      <button class="button btn-inti" name="login" id="login">Login</button>
      <div class="signup_link">
        Belum punya akun? <a href="user/daftar.php">Daftar</a>
      </div>
    </form>
  </div>

</body>

</html>