<?php
include '../process/koneksi.php'; // Ganti dengan file koneksi database Anda

// Mendapatkan IP Address pengguna
function getUserIP() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP dari shared internet
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP dari proxy
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // IP dari remote address
        return $_SERVER['REMOTE_ADDR'];
    }
}

// Ambil IP address
$user_ip = getUserIP();

// Ambil waktu saat ini
$access_time = date('Y-m-d H:i:s');

// Simpan data ke database
$sql = "INSERT INTO viewers (ip_address, access_time) VALUES ('$user_ip', '$access_time')";

if (mysqli_query($conn, $sql)) {
} else {
    echo "Error: " . mysqli_error($conn);
}
?>
