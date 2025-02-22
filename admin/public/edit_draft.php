<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Notulensi - IDM</title>
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
                <div class="container px-6 mx-auto grid">
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Edit Draft
                    </h2>
                    <?php
                    // Ambil ID dari parameter URL
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        // Koneksi ke database
                        include_once '../controllers/koneksi.php';

                        // Query untuk mengambil data draft berdasarkan ID
                        $sql = "SELECT * FROM draft WHERE id_draft = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Periksa apakah data ditemukan
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $ket_draft = htmlspecialchars($row['ket_draft']);
                            $nama_draft = htmlspecialchars($row['nama_draft']);
                            $file_draft = htmlspecialchars($row['file_draft']);
                            $link_draft = htmlspecialchars($row['link_draft']);
                            $kategori_draft = htmlspecialchars($row['kategori_draft']);
                        } else {
                            echo "Data tidak ditemukan!";
                            exit;
                        }

                        // Tutup statement dan koneksi
                        $stmt->close();
                        $conn->close();
                    } else {
                        echo "ID tidak ditemukan!";
                        exit;
                    }
                    ?>

                    <form action="../controllers/update_draft.php" method="POST" enctype="multipart/form-data">
                        <!-- Pastikan ID dikirim untuk update -->
                        <input type="hidden" name="id_draft" value="<?php echo htmlspecialchars($id); ?>" />
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                            <label class="block mt-4 text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Kategori</span>
                                <select name="kategori"
                                    class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                    <option value="BPH" <?php echo ($kategori_draft === 'BPH') ? 'selected' : ''; ?>>BPH
                                    </option>
                                    <option value="Kementrian IDM" <?php echo ($kategori_draft === 'Kementrian IDM') ? 'selected' : ''; ?>>Kementrian IDM</option>
                                    <option value="Multimedia" <?php echo ($kategori_draft === 'Multimedia') ? 'selected' : ''; ?>>Multimedia</option>
                                    <option value="Grafis" <?php echo ($kategori_draft === 'Grafis') ? 'selected' : ''; ?>>Grafis</option>
                                    <option value="Game" <?php echo ($kategori_draft === 'Game') ? 'selected' : ''; ?>>
                                        Game</option>
                                    <option value="Sinematik dan Fotografi" <?php echo ($kategori_draft === 'Sinematik dan Fotografi') ? 'selected' : ''; ?>>Sinematik dan Fotografi</option>
                                    <option value="Lainnya" <?php echo ($kategori_draft === 'Lainnya') ? 'selected' : ''; ?>>Lainnya</option>
                                </select>
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Judul Draft</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    type="text" id="nama_draft" name="nama_draft" required placeholder="Judul Draft"
                                    value="<?php echo $nama_draft; ?>" />
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Keterangan</span>
                                <textarea
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    name="ketdraft" id="ketdraft"
                                    placeholder="Keterangan"><?php echo $ket_draft; ?></textarea>
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">File (PDF)</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    type="file" id="file" name="file" accept=".pdf" />
                                <small>Current file: <?php echo $file_draft ? $file_draft : 'None'; ?></small>
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Link Draft</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray"
                                    type="text" id="linkdraft" name="linkdraft" placeholder="https://example.com"
                                    value="<?php echo $link_draft ? $link_draft : '-'; ?>" />
                            </label>

                        </div>

                        <footer>
                            <button type="button" onclick="history.back()"
                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                Cancel
                            </button>
                            <button type="submit"
                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Accept
                            </button>
                        </footer>
                    </form>

            </main>
        </div>
    </div>
</body>

</html>