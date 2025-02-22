<?php
// Menghubungkan ke file koneksi
require 'admin/controllers/koneksi.php';

// Mengambil data dari tabel photobooth
$sql = "SELECT * FROM photobooth";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Photobooth</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        h1 {
            color: #333;
            margin-bottom: 20px;
        }
        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
            max-width: 1200px;
            width: 100%;
        }
        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.2s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card img {
            max-width: 100%;
            height: auto;
            border-bottom: 1px solid #e0e0e0;
        }
        .card-content {
            padding: 15px;
            text-align: center;
        }
        .card-content p {
            margin: 8px 0;
            color: #555;
        }
        .download-btn {
            background-color: #007bff;
            border: none;
            border-radius: 4px;
            color: white;
            cursor: pointer;
            font-size: 16px;
            padding: 10px 15px;
            transition: background-color 0.3s;
        }
        .download-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<h1>Data Photobooth</h1>

<div class="grid">
<?php
// Periksa apakah ada hasil
if ($result->num_rows > 0) {
    // Tampilkan data setiap baris
    while ($row = $result->fetch_assoc()) {
        $imagePath = 'admin/public/src/filephotobooth/' . $row['img_real']; // Ganti dengan nama kolom yang sesuai

        echo '<div class="card">';
        echo '<img src="' . htmlspecialchars($imagePath) . '" alt="' . htmlspecialchars($row['nama']) . '">';
        echo '<div class="card-content">';
        echo '<p><strong>Nama:</strong> ' . htmlspecialchars($row['nama']) . '</p>';
        echo '<a href="' . htmlspecialchars($imagePath) . '" download>
                <button class="download-btn">
                    <i class="fas fa-download"></i> Download
                </button>
              </a>';
        echo '</div>'; // card-content
        echo '</div>'; // card
    }
} else {
    echo '<p>Tidak ada data ditemukan.</p>';
}

// Tutup koneksi
$conn->close();
?>
</div>

</body>
</html>
