<?php
include "koneksi.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $hash = password_hash($password, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hash')";
    
    if (mysqli_query($koneksi, $query)) {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            title: 'Akun $username berhasil dibuat!',
            icon: 'success',
            confirmButtonColor: '#8d6748'
        }).then(function(){
            window.location = 'login.php';
        });
        </script>";
    } else {
        echo "<script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        <script>
        Swal.fire({
            title: 'Gagal membuat akun!',
            text: 'Terjadi kesalahan pada server.',
            icon: 'error',
            confirmButtonColor: '#8d6748'
        });
        </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar | Toko Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light" style="background: linear-gradient(120deg, #d2b48c 60%, #fff 100%);">

<div class="container">
  <div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-5 col-lg-4">
      <div class="card border-0 shadow" style="border: 1px solid #d2b48c; border-radius: 1rem;">
        <div class="card-body p-4">
          <h3 class="fw-bold text-center mb-2" style="color:#4e342e;">Toko Buku</h3>
          <p class="text-center text-muted mb-4">Buat akun baru untuk melanjutkan</p>

          <form method="post">
            <div class="mb-3">
              <label class="form-label fw-semibold">Username</label>
              <input type="text" name="username" class="form-control" required autocomplete="off" 
                value="<?= isset($_POST['username']) ? $_POST['username'] : '' ?>">
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Email</label>
              <input type="email" name="email" class="form-control" required autocomplete="off"
                value="<?= isset($_POST['email']) ? $_POST['email'] : '' ?>">
            </div>
            <div class="mb-3">
              <label class="form-label fw-semibold">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn w-100 text-white fw-semibold" 
              style="background-color:#8d6748; border-radius:0.6rem;">
              Daftar
            </button>
          </form>

          <p class="text-center mt-3 mb-0 small">
            Sudah punya akun? 
            <a href="login.php" class="fw-semibold text-decoration-none" style="color:#8d6748;">
              Login
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
