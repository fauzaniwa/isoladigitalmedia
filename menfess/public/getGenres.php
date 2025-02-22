<?php
// Menghubungkan ke database
include '../process/koneksi.php';  // Pastikan ini adalah path yang benar ke file koneksi.php

// Query untuk mengambil 5 genre acak dari tabel 'genres'
$sql = "SELECT genre_name FROM genres ORDER BY RAND() LIMIT 5";
$result = $conn->query($sql);

// Menyusun data genre dalam array
$genres = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $genres[] = $row;
    }
}

// Menutup koneksi
$conn->close();

// Mengirim data genre dalam format JSON
echo json_encode($genres);
?>
