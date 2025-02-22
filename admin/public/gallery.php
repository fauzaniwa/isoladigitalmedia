<?php
// Cek apakah ada parameter status di URL
if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 'success') {
        echo "<script>alert('Berhasil menambahkan gallery!');</script>";
    } elseif ($status == 'error') {
        echo "<script>alert('Gagal menambahkan gallery!');</script>";
    } elseif ($status == 'success_delete') {
        echo "<script>alert('Berhasil menghapus gallery!');</script>";
    } elseif ($status == 'error_delete') {
        echo "<script>alert('Gagal menghapus gallery!');</script>";
    } elseif ($status == 'success_edit') {
        echo "<script>alert('Berhasil mengedit gallery!');</script>";
    } elseif ($status == 'error_edit') {
        echo "<script>alert('Gagal mengedit gallery!');</script>";
    }
}
?>
<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gallery - IDM</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        <!-- Desktop sidebar -->
        <?php include 'aside.php'; ?>

        <div class="flex flex-col flex-1">
            <?php include 'header.php'; ?>
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Gallery
                    </h2>
                    <div class="py-4">
                        <a href="gallery_add">
                            <button
                                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                <span>Create New</span>
                            </button>

                        </a>
                    </div>
                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
                        <?php
                        // Include koneksi ke database
                        include '../controllers/koneksi.php';

                        // Query untuk mengambil data dari tabel gallery
                        $query = "SELECT * FROM gallery ORDER BY created_at DESC";
                        $result = $conn->query($query);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $judul = $row['judul'];
                                $namaFile = $row['nama_file'];
                                $createdAt = date("d F Y", strtotime($row['created_at']));
                                $imagePath = "./src/gallery/" . $namaFile;
                                ?>
                                <div class="relative">
                                    <img src="<?php echo $imagePath; ?>" alt="<?php echo $judul; ?>"
                                        class="w-full h-48 object-cover rounded-lg shadow-md" />
                                    <div
                                        class="absolute inset-0 bg-black opacity-0 hover:opacity-50 transition-opacity rounded-lg flex items-center justify-center">
                                        <span class="text-white font-semibold text-lg"><?php echo $judul; ?></span>
                                    </div>
                                    <div class="mt-2 text-center text-gray-700 dark:text-gray-200">
                                        <h3 class="text-lg font-semibold"><?php echo $judul; ?></h3>
                                        <p class="text-gray-500"><?php echo $createdAt; ?></p>
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "Belum ada gambar di dalam gallery.";
                        }
                        ?>
                    </div>


                </div>


            </main>

        </div>
    </div>
</body>

</html>