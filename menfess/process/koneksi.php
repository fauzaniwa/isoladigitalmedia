<?php
// Konfigurasi database
// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "tellyourstory";

$servername = "localhost";
$username = "u896947927_idmmenfess";
$password = "Mediadigitalisola2021*";
$dbname = "u896947927_dbmenfess";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Mengecek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

?>
