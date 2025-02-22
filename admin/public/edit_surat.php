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
                        Edit Surat
                    </h2>
                    <?php
                    // Ambil ID dari parameter URL
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        // Koneksi ke database
                        include_once '../controllers/koneksi.php';

                        // Query untuk mengambil data surat berdasarkan ID
                        $sql = "SELECT * FROM surat WHERE id_nosurat = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Periksa apakah data ditemukan
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $ket_surat = $row['ket_surat'];
                            $no_surat = $row['no_surat'];
                            $file_surat = $row['file_surat'];
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

                    <form action="../controllers/update_surat.php" method="POST" enctype="multipart/form-data">
                        <!-- Pastikan ID dikirim untuk update -->
                        <input type="hidden" name="id_nosurat" value="<?php echo $id; ?>" />

                        <!-- Modal body -->
                        <div class="mt-4 mb-6">
                            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">No Surat</span>
                                    <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="text" id="nosurat" name="nosurat" required placeholder="No Surat"
                                        value="<?php echo htmlspecialchars($no_surat); ?>" />
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Ket Surat</span>
                                    <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="text" id="ketsurat" name="ketsurat" required placeholder="Keterangan Surat"
                                        value="<?php echo htmlspecialchars($ket_surat); ?>" />
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">File (PDF)</span>
                                    <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="file" id="filesurat" name="filesurat" accept=".pdf" />
                                    <p class="dark:text-gray-300">File saat ini: <a href="<?php echo htmlspecialchars($file_surat); ?>"
                                            target="_blank"><?php echo basename($file_surat); ?></a></p>
                                </label>

                            </div>
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