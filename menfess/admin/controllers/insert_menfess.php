<?php
// Mengimpor file koneksi
include './koneksi.php';

// Periksa apakah data dikirim melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];
    $message = $_POST['menssage']; // Pastikan nama field benar sesuai form
    $music = $_POST['music'];

    // Query untuk menyimpan data ke dalam tabel menfess
    $sql = "INSERT INTO menfess (name, message, music) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameter dan eksekusi query
    $stmt->bind_param("sss", $name, $message, $music);

    if ($stmt->execute()) {
        header("Location: ../public/menfess?status=success");
        exit();
    } else {
        echo "Terjadi kesalahan saat menyimpan data: " . $stmt->error;
    }

    // Menutup statement
    $stmt->close();
}

// Menutup koneksi
$conn->close();
?>
