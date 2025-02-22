<?php
// Mengimpor file koneksi
include './koneksi.php';

// Fungsi untuk membuat slug random 8 karakter
function generateRandomSlug($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomSlug = '';
    for ($i = 0; $i < $length; $i++) {
        $randomSlug .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomSlug;
}

// Fungsi untuk memeriksa apakah slug sudah ada di database
function isSlugExists($conn, $slug) {
    $sql = "SELECT COUNT(*) as count FROM menfess WHERE slug = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $slug);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();
    return $result['count'] > 0;
}

// Periksa apakah data dikirim melalui POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $name = $_POST['name'];
    $message = $_POST['message']; // Pastikan nama field benar sesuai form
    $music = $_POST['music'];
    $usernameig = $_POST['usernameig']; // Ambil username Instagram dari form
    $ip_address = $_SERVER['REMOTE_ADDR']; // Tangkap IP Address pengguna

    // Periksa nilai dari checkbox "Allowed Users Comments"
    $can_comment = isset($_POST['allowedComments']) ? 1 : 0; // Jika dicentang, set 1, jika tidak, set 0

    // Periksa apakah IP Address sudah mengunggah lebih dari 2 kali di hari yang sama
    $query = "SELECT COUNT(*) as count FROM menfess WHERE IP_Address = ? AND DATE(created_at) = CURDATE()";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $ip_address);
    $stmt->execute();
    $result = $stmt->get_result()->fetch_assoc();

    if ($result['count'] >= 2) {
        // Jika terdeteksi spam, hentikan eksekusi
        header("Location: ../public/submit?status=spam");
        exit();
    }
    

    

    // Generate slug unik
    $slug = generateRandomSlug();
    while (isSlugExists($conn, $slug)) {
        $slug = generateRandomSlug(); // Buat ulang jika slug sudah ada
    }

    // Query untuk mengambil semua kata kasar dari tabel filter_kata
    $query = "SELECT kata FROM filter_kata";
    $result = $conn->query($query);
    $badWords = [];

    // Menyimpan semua kata kasar dalam array
    while ($row = $result->fetch_assoc()) {
        $badWords[] = $row['kata'];
    }

    // Periksa apakah pesan mengandung kata-kata kasar
    foreach ($badWords as $badWord) {
        if (stripos($message, $badWord) !== false) {
            // Jika ditemukan kata kasar, tampilkan peringatan dan hentikan eksekusi
            header("Location: ../public/submit.php?alert=term&badword=" . urlencode($badWord));
            exit();
        }
    }

    // Jika tidak ada kata kasar, lanjutkan untuk menyimpan data
    $sql = "INSERT INTO menfess (name, usernameig, message, music, IP_Address, can_comment, slug) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Bind parameter dan eksekusi query
    $stmt->bind_param("sssssis", $name, $usernameig, $message, $music, $ip_address, $can_comment, $slug);

    if ($stmt->execute()) {
        // Redirect ke halaman submit dengan status sukses
        header("Location: ../public/submit?status=success");
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
