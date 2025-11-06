<?php 
include "koneksi.php"; 
session_start();

$login = isset($_SESSION['login']) ? $_SESSION['login'] : false;

if($login === true){
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Login | Toko Buku</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light" style="background: linear-gradient(120deg, #d2b48c 60%, #fff 100%);">

<?php 
if($_SERVER['REQUEST_METHOD'] === "POST"){
    $nama = $_POST['nama'];
    $sqlUser = mysqli_query($koneksi, "SELECT * FROM users WHERE username = '$nama'");
    
    if(mysqli_num_rows($sqlUser)){
        $user = mysqli_fetch_assoc($sqlUser);
        if(password_verify($_POST['password'], $user['password'])){
            $_SESSION['login'] = true;
            $_SESSION['id'] = $user['id'];
            $_SESSION['nama'] = $user['username'];
            echo " 
                <script>
                    Swal.fire({
                        title: 'Selamat datang, $nama!',
                        icon: 'success',
                        confirmButtonColor: '#8d6748'
                    }).then(() => {
                        window.location = 'index.php';
                    });
                </script>
            ";
        } else {
            echo " 
                <script>
                Swal.fire({
                    title: 'Password salah!',
                    icon: 'warning',
                    confirmButtonColor: '#8d6748'
                });
                </script>
            ";
        }
    } else {
        echo "
            <script>
                Swal.fire({
                    title: 'Username $nama belum terdaftar!',
                    icon: 'warning',
                    confirmButtonColor: '#8d6748'
                });
            </script>
        ";
    }
}
?>

<div class="container">
  <div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-5 col-lg-4">
      <div class="card border-0 shadow" style="border: 1px solid #d2b48c; border-radius: 1rem;">
        <div class="card-body p-4">
          <h3 class="fw-bold text-center mb-2" style="color: #4e342e;">Toko Buku</h3>
          <p class="text-center text-muted mb-4">Masuk ke akun Anda</p>

          <form method="POST">
            <div class="mb-3">
              <label for="nama" class="form-label fw-semibold">Username</label>
              <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label fw-semibold">Kata Sandi</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan kata sandi" required>
            </div>
            <button type="submit" class="btn w-100 mt-3 text-white fw-semibold" style="background-color: #8d6748; border-radius: 0.6rem;">
              Login
            </button>
          </form>

          <p class="text-center mt-3 mb-0 small">
            Belum punya akun? 
            <a href="register.php" class="fw-semibold" style="color: #8d6748; text-decoration: none;">
              Daftar Sekarang
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
