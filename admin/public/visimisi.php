<?php
// Cek apakah ada parameter status di URL
if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 'success') {
        echo "<script>alert('Berhasil menambahkan visi misi!');</script>";
    } elseif ($status == 'error') {
        echo "<script>alert('Gagal menambahkan visi misi!');</script>";
    } elseif ($status == 'success_delete') {
        echo "<script>alert('Berhasil menghapus visi misi!');</script>";
    } elseif ($status == 'error_delete') {
        echo "<script>alert('Gagal menghapus visi misi!');</script>";
    } elseif ($status == 'success_update') {
        echo "<script>alert('Berhasil update visi misi!');</script>";
    } elseif ($status == 'error_update') {
        echo "<script>alert('Gagal update visi misi!');</script>";
    }
}
?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Visi Misi - IDM</title>
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
                        Visi Misi
                    </h2>

                    <?php
                    // Include database connection
                    include '../controllers/koneksi.php';

                    // Check if there is any existing data in the visi_misi table
                    $sql = "SELECT COUNT(*) as count FROM visi_misi";
                    $result = $conn->query($sql);

                    $dataExists = false;
                    if ($result && $row = $result->fetch_assoc()) {
                        if ($row['count'] > 0) {
                            $dataExists = true;
                        }
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                    <div class="py-4">
                        <?php if ($dataExists): ?>
                            <button @click="openModal"
                                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                <span>Update Visi Misi</span>
                            </button>
                        <?php else: ?>
                            <button @click="openModal"
                                class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                <span>Create New</span>
                            </button>
                        <?php endif; ?>
                    </div>
                    <div class="grid gap-6 mb-8 md:grid-cols-1">
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                Visi
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">
                                <?php
                                // Include the script to fetch the data
                                include '../controllers/fetch_visimisi.php';
                                echo htmlspecialchars($visi_text, ENT_QUOTES, 'UTF-8');
                                ?>
                            </p>
                        </div>
                        <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <h4 class="mb-4 font-semibold text-gray-600 dark:text-gray-300">
                                Misi
                            </h4>
                            <p class="text-gray-600 dark:text-gray-400">
                                <?php
                                // Include the script to fetch the data
                                include '../controllers/fetch_visimisi.php';
                                echo htmlspecialchars($misi_text, ENT_QUOTES, 'UTF-8');
                                ?>
                            </p>
                        </div>
                    </div>

                                    <!-- Modal backdrop. This what you want to place close to the closing body tag -->
                <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                    <!-- Modal -->
                    <form action="../controllers/insert_visimisi.php" method="POST" enctype="multipart/form-data">
                        <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
                            x-transition:enter-start="opacity-0 transform translate-y-1/2"
                            x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0  transform translate-y-1/2" @click.away="closeModal"
                            @keydown.escape="closeModal"
                            class="w-full px-6 py-4 overflow-hidden bg-white rounded-t-lg dark:bg-gray-800 sm:rounded-lg sm:m-4 sm:max-w-xl"
                            role="dialog" id="modal">
                            <!-- Remove header if you don't want a close icon. Use modal body to place modal tile. -->
                            <header class="flex justify-end">
                                <button
                                    class="inline-flex items-center justify-center w-6 h-6 text-gray-400 transition-colors duration-150 rounded dark:hover:text-gray-200 hover: hover:text-gray-700"
                                    aria-label="close" @click="closeModal">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" role="img"
                                        aria-hidden="true">
                                        <path
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" fill-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </header>
                            <!-- Modal body -->
                            <div class="mt-4 mb-6">
                                <!-- Modal title -->
                                <p class="mb-2 text-lg font-semibold text-gray-700 dark:text-gray-300">
                                    Visi Misi
                                </p>
                                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Visi</span>
                                        <textarea required name="visi" id="visi"
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                                            <?php
                                            // Include the script to fetch the data
                                            include '../controllers/fetch_visimisi.php';
                                            echo htmlspecialchars($visi_text, ENT_QUOTES, 'UTF-8');
                                            ?>
                                            </textarea>
                                    </label>

                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Misi</span>
                                        <textarea required name="misi" id="misi"
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input">
                                            <?php
                                            // Include the script to fetch the data
                                            include '../controllers/fetch_visimisi.php';
                                            echo htmlspecialchars($misi_text, ENT_QUOTES, 'UTF-8');
                                            ?>
                                        </textarea>
                                    </label>
                                </div>
                            </div>
                            <footer
                                class="flex flex-col items-center justify-end px-6 py-3 -mx-6 -mb-4 space-y-4 sm:space-y-0 sm:space-x-6 sm:flex-row bg-gray-50 dark:bg-gray-800">
                                <button @click="closeModal"
                                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                    Cancel
                                </button>
                                <button type="submit"
                                    class="w-full px-5 py-3 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg sm:w-auto sm:px-4 sm:py-2 active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                    Accept
                                </button>
                            </footer>
                        </div>
                    </form>
                </div>
                </div>



            </main>
        </div>
    </div>
</body>

</html>