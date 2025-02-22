<?php
// Mengimpor file koneksi
require_once '../controllers/koneksi.php'; // Sesuaikan jalur ke koneksi.php

// Query untuk mengambil data frame
$sql = "SELECT id_frame, nama_frame, total_frame FROM frame_artbooth";
$result = $conn->query($sql);

$frames = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $frames[] = $row;
    }
}

// Mengembalikan hasil sebagai JSON
echo json_encode($frames);

// Menutup koneksi
$conn->close();
?>
