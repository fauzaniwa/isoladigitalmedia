<?php
// Cek apakah ada parameter status di URL
if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 'success') {
        echo "<script>alert('Berhasil menambahkan surat!');</script>";
    } elseif ($status == 'error') {
        echo "<script>alert('Gagal menambahkan surat!');</script>";
    } elseif ($status == 'success_delete') {
        echo "<script>alert('Berhasil menghapus surat!');</script>";
    } elseif ($status == 'error_delete') {
        echo "<script>alert('Gagal menghapus surat!');</script>";
    } elseif ($status == 'success_edit') {
        echo "<script>alert('Berhasil mengedit surat!');</script>";
    } elseif ($status == 'error_edit') {
        echo "<script>alert('Gagal mengedit surat!');</script>";
    }
}
?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Nomor Surat - IDM</title>
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
                        Nomor Surat
                    </h2>
                    <div class="py-4">
                        <button @click="openModal"
                            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <span>Create New</span>
                        </button>
                    </div>
                    <?php
                    require_once '../controllers/koneksi.php'; // Menghubungkan ke database
                    
                    // Pencarian dan Filter
                    $search = isset($_GET['search']) ? $_GET['search'] : '';
                    $limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 15;
                    $counter = $offset + 1;

                    // Query SQL untuk pencarian dan filter data
                    $sql = "SELECT * FROM surat 
WHERE no_surat LIKE ? OR ket_surat LIKE ?
ORDER BY created_at DESC 
LIMIT ?";
                    $stmt = $conn->prepare($sql);
                    $searchParam = '%' . $search . '%';
                    $stmt->bind_param('ssi', $searchParam, $searchParam, $limit);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    ?>
                    <!-- Filter and Search Form -->
                    <form method="GET" action=""
                        class="w-full overflow-hidden rounded-lg shadow-xs p-4 dark:text-gray-200">
                        <div class="flex items-center space-x-4 grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-6">
                            <!-- Search Bar -->
                            <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>"
                                placeholder="Search by No / Keterangan"
                                class="px-4 py-2 border rounded-lg flex items-center bg-white rounded-lg shadow-xs dark:bg-gray-800">

                            <!-- Filter Show -->
                            <select name="limit" onchange="this.form.submit()"
                                class="px-4 py-2 border rounded-lg flex items-center bg-white rounded-lg shadow-xs dark:bg-gray-800">
                                <option value="25" <?= $limit == 25 ? 'selected' : '' ?>>Show 25</option>
                                <option value="50" <?= $limit == 50 ? 'selected' : '' ?>>Show 50</option>
                                <option value="100" <?= $limit == 100 ? 'selected' : '' ?>>Show 100</option>
                                <option value="500" <?= $limit == 500 ? 'selected' : '' ?>>Show 500</option>
                                <option value="1000" <?= $limit == 1000 ? 'selected' : '' ?>>Show 1000</option>
                            </select>
                        </div>
                    </form>
                    <!-- New Table -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">No.</th>
                                        <th class="px-4 py-3">Nomor Surat</th>
                                        <th class="px-4 py-3">Keterangan</th>
                                        <th class="px-4 py-3">File</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <?php if ($result->num_rows > 0): ?>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr class="text-gray-700 dark:text-gray-400">
                                                <td class="px-4 py-3 text-sm"><?php echo $counter++; ?></td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div>
                                                            <p class="font-semibold">
                                                                <?php echo htmlspecialchars($row['no_surat']); ?></p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm"><?php echo htmlspecialchars($row['ket_surat']); ?>
                                                </td>
                                                <td class="px-4 py-3 text-xs">
                                                    <a class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full dark:bg-green-700 dark:text-green-100"
                                                        href="./src/filesurat/<?php echo htmlspecialchars($row['file_surat']); ?>">
                                                        File
                                                    </a>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center space-x-4 text-sm">
                                                        <!-- Edit Button -->
                                                        <a href="edit_surat?id=<?php echo htmlspecialchars($row['id_nosurat']); ?>"
                                                            class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-purple-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                            aria-label="Edit">
                                                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                                                </path>
                                                            </svg>
                                                        </a>

                                                        <!-- Delete Button -->
                                                        <form method="POST" action="../controllers/delete_surat.php"
                                                            onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo htmlspecialchars($row['id_nosurat']); ?>">
                                                            <button type="submit"
                                                                class="flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray"
                                                                aria-label="Delete">
                                                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor"
                                                                    viewBox="0 0 20 20">
                                                                    <path fill-rule="evenodd"
                                                                        d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                                        clip-rule="evenodd"></path>
                                                                </svg>
                                                            </button>
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    <?php else: ?>
                                        <tr class="text-gray-700 dark:text-gray-400">
                                            <td colspan="5" class="px-4 py-3 text-center text-sm">
                                                Tidak ada data surat.
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php
                    // Close statement and connection
                    $stmt->close();
                    $conn->close();
                    ?>

                </div>


                <!-- Add New Surat -->
                <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                    <!-- Modal -->
                    <form action="../controllers/insert_surat.php" method="POST" enctype="multipart/form-data">
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
                                    Tambah Nomor Surat
                                </p>
                                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Nomor Surat</span>
                                        <input
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                            type="text" id="no_surat" name="no_surat" required placeholder=".../.../..." />
                                    </label>

                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Keterangan</span>
                                        <input
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                            type="text" id="keterangan" name="keterangan" required
                                            placeholder="Keterangan" />
                                    </label>

                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">File (PDF)</span>
                                        <input
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                            type="file" id="file" name="file" required accept=".pdf" />
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
                    </form>
                </div>


        </div>
        </main>
    </div>
    </div>
</body>

</html>