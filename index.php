<?php 
include 'koneksi.php';
session_start();

$login = isset($_SESSION['login']) ? $_SESSION['login'] : false;

// Cek apakah user sudah login atau belum
if($login === false){
    header("Location:login.php");
    exit;
}
// Daftar buku statis (bisa diganti dari database nanti)
$buku = [
    1 => ["judul" => "Laskar Pelangi", "harga" => 55000, "gambar" => "https://ik.imagekit.io/ns04umxc68/LASKAR%20PELANGI.jpeg?updatedAt=1762437730967"],
    2 => ["judul" => "Filosofi Teras", "harga" => 70000, "gambar" => "https://ik.imagekit.io/ns04umxc68/FILOSOFI.jpeg?updatedAt=1762437730831"],
    3 => ["judul" => "Atomic Habits", "harga" => 85000, "gambar" => "https://ik.imagekit.io/ns04umxc68/ATOMIC%20HABITS.jpeg?updatedAt=1762437730840"],
    4 => ["judul" => "Rich Dad Poor Dad", "harga" => 90000, "gambar" => "https://ik.imagekit.io/ns04umxc68/HABIT.png?updatedAt=1762437730834"],
    5 => ["judul" => "Sapiens: A Brief History of Humankind", "harga" => 120000, "gambar" => "https://ik.imagekit.io/ns04umxc68/SAPIENS.jpeg?updatedAt=1762437731011"],
    6 => ["judul" => "The Subtle Art of Not Giving a F*ck", "harga" => 95000, "gambar" => "https://ik.imagekit.io/ns04umxc68/THE%20SUBTITLE%20ART%20OF%20NOT%20GIVING.jpeg?updatedAt=1762437731048"],
    7 => ["judul" => "Deep Work", "harga" => 88000, "gambar" => "https://ik.imagekit.io/ns04umxc68/DEEP%20WORK.jpeg?updatedAt=1762437730859"],
    8 => ["judul" => "Think and Grow Rich", "harga" => 99000, "gambar" => "https://ik.imagekit.io/ns04umxc68/THINK%20GROW%20RICH.jpeg?updatedAt=1762437731135"],
    9 => ["judul" => "The Psychology of Money", "harga" => 87000, "gambar" => "https://ik.imagekit.io/ns04umxc68/PSYCHOLOGY%20MONEY.jpeg?updatedAt=1762437731039"],
    10 => ["judul" => "Ikigai: The Japanese Secret to a Long and Happy Life", "harga" => 89000, "gambar" => "https://ik.imagekit.io/ns04umxc68/IKIGAI.jpeg?updatedAt=1762437730895"],
    11 => ["judul" => "Start With Why", "harga" => 93000, "gambar" => "https://ik.imagekit.io/ns04umxc68/START%20WITH%20WHY.jpeg?updatedAt=1762437730981"],
    12 => ["judul" => "The 7 Habits of Highly Effective People", "harga" => 97000, "gambar" => "https://ik.imagekit.io/ns04umxc68/7%20HIGHEY%20EFECTTIVE%20PEOPLE.jpeg?updatedAt=1762437730887"],
    13 => ["judul" => "Can't Hurt Me", "harga" => 105000, "gambar" => "https://ik.imagekit.io/ns04umxc68/CAN%20HURT%20ME.jpeg?updatedAt=1762437730828"],
    14 => ["judul" => "Ego is the Enemy", "harga" => 91000, "gambar" => "https://ik.imagekit.io/ns04umxc68/EGO%20IS%20THE%20ENEMY.jpeg?updatedAt=1762437731089"],
    15 => ["judul" => "Make Time", "harga" => 88000, "gambar" => "https://ik.imagekit.io/ns04umxc68/MAKE%20TIME.png?updatedAt=1762437730847"],
    16 => ["judul" => "The Power of Habit", "harga" => 94000, "gambar" => "https://ik.imagekit.io/ns04umxc68/HABIT.png?updatedAt=1762437730834"],
    17 => ["judul" => "How to Win Friends and Influence People", "harga" => 86000, "gambar" => "https://ik.imagekit.io/ns04umxc68/HOW%20TO%20WIN%20FRIEND.jpeg?updatedAt=1762437730917"],
    18 => ["judul" => "Man’s Search for Meaning", "harga" => 90000, "gambar" => "https://ik.imagekit.io/ns04umxc68/Man_s%20Search%20for%20Meaning.jpeg?updatedAt=1762437730923"],
    19 => ["judul" => "The 48 Laws of Power", "harga" => 115000, "gambar" => "https://ik.imagekit.io/ns04umxc68/POWER%20LAW.png?updatedAt=1762437730902"],
    20 => ["judul" => "Outliers", "harga" => 95000, "gambar" => "https://ik.imagekit.io/ns04umxc68/OUTLIER.jpeg?updatedAt=1762437731030"],
    21 => ["judul" => "The Alchemist", "harga" => 83000, "gambar" => "https://ik.imagekit.io/ns04umxc68/THE%20ALCHEMIST.jpeg?updatedAt=1762437731137"],
    22 => ["judul" => "Dune", "harga" => 99000, "gambar" => "https://ik.imagekit.io/ns04umxc68/DUNE.jpeg?updatedAt=1762437730876"],
    23 => ["judul" => "Becoming", "harga" => 98000, "gambar" => "https://ik.imagekit.io/ns04umxc68/BECOMING.jpeg?updatedAt=1762437730853"],
    24 => ["judul" => "Educated", "harga" => 97000, "gambar" => "https://ik.imagekit.io/ns04umxc68/EDUCATED.jpeg?updatedAt=1762437730864"],
    25 => ["judul" => "The Intelligent Investor", "harga" => 120000, "gambar" => "https://ik.imagekit.io/ns04umxc68/THE%20INTELLEGENT%20IVENSTOR.jpeg?updatedAt=1762437731099"],
];


// Proses tambah ke keranjang
if (isset($_GET['beli'])) {
    $id = $_GET['beli'];

    // Pastikan ID buku valid
    if (isset($buku[$id])) {
        // Jika keranjang belum ada, buat baru
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Jika buku sudah ada di keranjang, tambahkan jumlahnya
        if (isset($_SESSION['cart'][$id])) {
            $_SESSION['cart'][$id]['jumlah']++;
        } else {
            // Jika belum ada, tambahkan baru
            $_SESSION['cart'][$id] = [
                'judul' => $buku[$id]['judul'],
                'harga' => $buku[$id]['harga'],
                'jumlah' => 1
            ];
        }
    }

    // Setelah menambah, kembali ke index agar tidak menambah dua kali jika di-refresh
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Toko Buku</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
  body {
    font-family: 'Poppins', sans-serif;
    background: #f8f3ef;
    color: #3e2723;
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
  .hero {
    position: relative;
    background: url('https://ik.imagekit.io/b5geybata/pexels-suzyhazelwood-1333732.jpg?updatedAt=1760354345949') center/cover no-repeat;
    padding: 100px 0;
    color: #4e342e;
  }
  .hero::before {
    content: "";
    position: absolute;
    top: 0; left: 0;
    width: 100%; height: 100%;
    background: linear-gradient(120deg, rgba(210,180,140,0.7) 40%, rgba(248,243,239,0.7) 100%);
    z-index: 1;
  }
  .hero .container {
    position: relative;
    z-index: 2;
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
  .book-card {
    border-radius: 14px;
    overflow: hidden;
    border: none;
  }

  /* 🔥 Tambahan penting untuk samakan ukuran gambar */
  .book-card img {
    width: 100%;
    height: 250px;
    object-fit: cover;
    border-bottom: 1px solid #eee;
  }

  footer {
    background: #fff;
    border-top: 2px solid #d2b48c;
    color: #6d4c41;
  }
</style>

</head>

<body>

<nav class="navbar navbar-expand-lg shadow-sm">
  <div class="container">
    <a class="navbar-brand brand" href="#">Toko Buku</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto align-items-center">
        <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="index.php">Beranda</a></li>
        <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="keranjang.php">Keranjang (<?= isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0 ?>)</a></li>
        <li class="nav-item ms-3"><a class="btn btn-outline-dark" href="logout.php">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<section class="hero text-center">
  <div class="container">
    <h1 class="display-5 fw-bold">Temukan Buku Favoritmu</h1>
    <p class="lead">Mulai dari novel, edukasi, hingga pengembangan diri — semua ada di sini.</p>
    <a href="#koleksi" class="btn btn-main mt-3">Lihat Koleksi</a>
  </div>
</section>

<section class="py-5" id="koleksi">
  <div class="container">
    <h4 class="fw-semibold mb-4">Koleksi Buku</h4>
    <div class="row g-4">

      <?php foreach ($buku as $id => $data): ?>
        <div class="col-6 col-md-3">
          <div class="card book-card shadow-sm">
            <img src="<?= $data['gambar'] ?>" class="card-img-top" alt="<?= htmlspecialchars($data['judul']) ?>">
            <div class="card-body text-center">
              <h6 class="book-title mb-1"><?= htmlspecialchars($data['judul']) ?></h6>
              <p class="small text-muted">Rp<?= number_format($data['harga'], 0, ',', '.') ?></p>
              <a href="?beli=<?= $id ?>" class="btn btn-main btn-sm w-100">Beli Sekarang</a>
            </div>
          </div>
        </div>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
