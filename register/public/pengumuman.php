<?php
// Sertakan file sesi
include('session.php');

// Sertakan file koneksi database
include('../controllers/koneksi.php');

// Ambil user_id dari sesi
$user_id = $_SESSION['user_id'];

// Query untuk mengambil data anggota berdasarkan user_id
$sql = "SELECT * FROM anggota WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Tutup koneksi
$stmt->close();
$conn->close();

// Tentukan file yang akan disertakan berdasarkan status
$include_file = '';

switch ($user['status']) {
    case 'pending':
        $include_file = 'pengumuman-seleksi.php';
        break;
    case 'diterima':
        $include_file = 'pengumuman-selamat.php';
        break;
    case 'ditolak':
        $include_file = 'pengumuman-gagal.php';
        break;
    case 'wawancara':
        $include_file = 'pengumuman-wawancara.php';
        break;
    default:
        $include_file = 'pengumuman-seleksi.php';
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Page</title>
    <link href="./assets/css/tailwind.output.css" rel="stylesheet">
    <link href="./assets/css/styles.css" rel="stylesheet">
</head>

<body
    class="min-h-screen bg-white flex flex-col justify-center items-center bg-gradient-r from-custom-purple via-custom-pink to-custom-blue">
    <!-- Navbar for Mobile -->
    <nav
        class="md:hidden fixed w-full top-0 left-0 bg-gradient-r from-custom-purple via-custom-pink to-custom-blue shadow-lg z-50">
        <div class="container mx-auto flex items-center justify-center p-4">
            <a href="#" class="flex items-center">
                <img src="./assets/img/logoidm-white.png" alt="Isola Logo" class="w-48">
            </a>
        </div>
    </nav>

    <?php include($include_file); ?>

</body>

</html>