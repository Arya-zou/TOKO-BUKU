<?php
include 'koneksi.php';
session_start();

// Cek login
$login = isset($_SESSION['login']) ? $_SESSION['login'] : false;
if ($login === false) {
    header("Location:login.php");
    exit;
}

// Cek keranjang
$cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

// Hapus item dari keranjang
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    unset($_SESSION['cart'][$id]);
    header("Location: keranjang.php");
    exit;
}

// Nomor WhatsApp tujuan (ubah ke nomor kamu)
$nomor_wa = "6281362029235";

// pesan
if (!empty($cart)) {
    $pesan = " *Halo Admin TokoBuku!* \n\n";
    $pesan .= "Saya ingin memesan buku-buku berikut:\n\n";

    $no = 1;
    $grandTotal = 0;
    foreach ($cart as $item) {
        $total = $item['harga'] * $item['jumlah'];
        $grandTotal += $total;

        $pesan .= " *" . $no++ . ". " . $item['judul'] . "*\n";
        $pesan .= " Harga  : Rp" . number_format($item['harga'], 0, ',', '.') . "\n";
        $pesan .= " Jumlah : " . $item['jumlah'] . "\n";
        $pesan .= " Total  : Rp" . number_format($total, 0, ',', '.') . "\n";
        $pesan .= "━━━━━━━━━━━━━━━━━━━━━━━\n";
    }

    $pesan .= "\n *Total Pembayaran:* Rp" . number_format($grandTotal, 0, ',', '.') . "\n\n";
    $pesan .= "Mohon info ketersediaannya ya \n";
    $pesan .= "Terima kasih banyak \n\n";
    $pesan .= "_(Pesan otomatis dari website TokoBuku)_";

    // Encode pesan ke URL WhatsApp
    $link_wa = "https://wa.me/$nomor_wa?text=" . urlencode($pesan);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Keranjang | Toko Buku</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
 <style>
  html, body {
    height: 100%;
  }
  body {
    display: flex;
    flex-direction: column;
    font-family: 'Poppins', sans-serif;
    background: #f8f3ef;
    color: #3e2723;
  }
  main {
    flex: 1;
  }
  .navbar {
    background-color: #fff;
    border-bottom: 2px solid #d2b48c;
  }
  .brand {
    color: #8d6748;
    font-weight: 700;
    font-size: 1.4rem;
    text-decoration: none;
  }
  .btn-main {
    background-color: #8d6748;
    color: white;
    border-radius: 10px;
    border: none;
    transition: all 0.3s;
  }
  .btn-main:hover {
    background-color: #a07656;
    color: white;
  }
  footer {
    background: #fff;
    border-top: 2px solid #d2b48c;
    color: #6d4c41;
    padding: 1.5rem 0;
  }
</style>

</head>
<body>

<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand brand" href="index.php">Toko Buku</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="keranjang.php">Keranjang</a></li>
        <li class="nav-item ms-3"><a class="btn btn-outline-dark" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<main>
<section class="py-5">
  <div class="container">
    <h3 class="fw-semibold mb-4">Keranjang Belanja</h3>

    <?php if (empty($cart)) : ?>
      <div class="alert alert-warning text-center">Keranjang kamu masih kosong 😅</div>
      <div class="text-center">
        <a href="index.php" class="btn btn-main mt-3">Belanja Sekarang</a>
      </div>
    <?php else : ?>
      <div class="table-responsive">
        <table class="table align-middle table-bordered">
          <thead class="table-light">
            <tr class="text-center">
              <th>No</th>
              <th>Judul Buku</th>
              <th>Harga</th>
              <th>Jumlah</th>
              <th>Total</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $no = 1;
            $grandTotal = 0;
            foreach ($cart as $id => $item) :
              $total = $item['harga'] * $item['jumlah'];
              $grandTotal += $total;
            ?>
              <tr>
                <td class="text-center"><?= $no++ ?></td>
                <td><?= htmlspecialchars($item['judul']) ?></td>
                <td>Rp<?= number_format($item['harga'], 0, ',', '.') ?></td>
                <td class="text-center"><?= $item['jumlah'] ?></td>
                <td>Rp<?= number_format($total, 0, ',', '.') ?></td>
                <td class="text-center">
                  <a href="keranjang.php?hapus=<?= $id ?>" class="btn btn-sm btn-danger">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
            <tr>
              <td colspan="4" class="text-end fw-semibold">Total Bayar:</td>
              <td colspan="2" class="fw-bold">Rp<?= number_format($grandTotal, 0, ',', '.') ?></td>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="text-end mt-3">
        <a href="<?= $link_wa ?>" target="_blank" class="btn btn-main">
          💬 Pesan via WhatsApp
        </a>
      </div>
    <?php endif; ?>
  </div>
</section>
</main>

<?php include 'footer.php';?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
