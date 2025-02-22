<?php
// Mengimpor koneksi dari file lain
require_once '../controllers/koneksi.php'; // Pastikan jalur ini sesuai dengan lokasi file koneksi.php Anda

// Direktori untuk menyimpan gambar
$targetDir = "src/filephotobooth/";
$targetFile = $targetDir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Periksa apakah file gambar adalah gambar yang sebenarnya atau palsu
if (isset($_POST["fileName"])) {
    // Periksa apakah file adalah gambar
    $check = getimagesize($_FILES["file"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}

// Periksa jika file sudah ada
if (file_exists($targetFile)) {
    echo "Maaf, file sudah ada.";
    $uploadOk = 0;
}

// Hanya izinkan format file tertentu
if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan.";
    $uploadOk = 0;
}

// Periksa jika $uploadOk diatur ke 0 oleh kesalahan
if ($uploadOk == 0) {
    echo "Maaf, gambar Anda tidak diunggah.";
} else {
    // Jika semuanya baik-baik saja, coba unggah file
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
    } else {
        echo "Maaf, terjadi kesalahan saat mengunggah file Anda.";
    }
}
?>
