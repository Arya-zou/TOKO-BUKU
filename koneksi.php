<?php 
$hostname = "localhost";
$username = "root";
$password = "";
$database = "buku_tamu";
$koneksi = mysqli_connect($hostname, $username, $password, $database);

// if($koneksi->connect_error){
//     die("koneksi gagal: " . $koneksi->connect_error);
// }


if(!$koneksi){
    echo "koneksi gagal :" . mysqli_connect_error();
}
?>