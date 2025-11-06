<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php
    session_start();

    $login = isset($_SESSION['login']) ? $_SESSION['login'] : false;
    // cek apakah user sudah login atau belum
    if($login === false){
        header("Location: login.php");
        exit;
    }

    $nama = $_SESSION['nama'];
    echo "
        <script>
            Swal.fire({
            title: 'Goodbye $nama',
            icon: 'success'
            }).then(() => {
                window.location = 'login.php'
            });
        </script>
    ";
    session_destroy();

    ?>
</body>
</html>