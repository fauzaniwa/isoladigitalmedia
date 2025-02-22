<?php
// Cek apakah ada parameter status di URL
if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 'success') {
        echo "<script>alert('Berhasil menambahkan admin!');</script>";
    } elseif ($status == 'error') {
        echo "<script>alert('Gagal menambahkan admin!');</script>";
    } elseif ($status == 'success_delete') {
        echo "<script>alert('Berhasil menghapus admin!');</script>";
    } elseif ($status == 'error_delete') {
        echo "<script>alert('Gagal menghapus admin!');</script>";
    }
}

session_start();
?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin - IDM</title>
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
                        Admin
                    </h2>
                    <div class="py-4">
                        <button @click="openModal"
                            class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                            <span>Create New</span>
                        </button>
                    </div>
                    <?php
                    // Mulai sesi dan ambil data role dari session.php
                    
                    //include 'session.php'; // Sesuaikan path dengan lokasi sebenarnya
                    
                    // Debugging: Tampilkan nilai role admin
                    echo "<p class='dark:text-gray-300'>Role Admin: " . htmlspecialchars($_SESSION['admin_role']) . "</p>";

                    // Hubungkan ke database
                    require_once '../controllers/koneksi.php';

                    // Query untuk mengambil data dari tabel admins
                    $sql = "SELECT id, nama, email, created_at, role FROM admins";
                    $result = $conn->query($sql);
                    ?>

                    <!-- New Table -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">No.</th>
                                        <th class="px-4 py-3">Nama</th>
                                        <th class="px-4 py-3">Email</th>
                                        <th class="px-4 py-3">Role</th>
                                        <th class="px-4 py-3">Created</th>
                                        <?php if (trim($_SESSION['admin_role']) === 'superadmin'): ?>
                                            <th class="px-4 py-3">Actions</th>
                                        <?php endif; ?>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <?php
                                    // Cek apakah query berhasil dan ada data yang diambil
                                    if ($result && $result->num_rows > 0) {
                                        // Counter untuk nomor urut
                                        $counter = 1;

                                        // Looping untuk menampilkan setiap data admin
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<tr class='text-gray-700 dark:text-gray-400'>";
                                            echo "<td class='px-4 py-3 text-sm'>" . htmlspecialchars($counter++) . "</td>";
                                            echo "<td class='px-4 py-3'><div class='flex items-center text-sm'><div><p class='font-semibold'>" . htmlspecialchars($row['nama']) . "</p></div></div></td>";
                                            echo "<td class='px-4 py-3 text-sm'>" . htmlspecialchars($row['email']) . "</td>";
                                            echo "<td class='px-4 py-3 text-sm'>" . htmlspecialchars($row['role']) . "</td>";
                                            echo "<td class='px-4 py-3 text-sm'>" . htmlspecialchars($row['created_at']) . "</td>";

                                            // Tampilkan kolom Actions hanya jika role adalah superadmin
                                            if (trim($_SESSION['admin_role']) === 'superadmin') {
                                                echo "<td class='px-4 py-3 text-xs'>";
                                                echo "<div class='flex items-center space-x-4 text-sm'>";
                                                echo "<form method='POST' action='../controllers/delete_admin.php' onsubmit=\"return confirm('Are you sure you want to delete this item?');\">";
                                                echo "<input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>";
                                                echo "<button type='submit' class='flex items-center justify-between px-2 py-2 text-sm font-medium leading-5 text-red-600 rounded-lg dark:text-gray-400 focus:outline-none focus:shadow-outline-gray' aria-label='Delete'>";
                                                echo "<svg class='w-5 h-5' aria-hidden='true' fill='currentColor' viewBox='0 0 20 20'>";
                                                echo "<path fill-rule='evenodd' d='M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z' clip-rule='evenodd'></path>";
                                                echo "</svg>";
                                                echo "</button>";
                                                echo "</form>";
                                                echo "</div>";
                                                echo "</td>";
                                            }

                                            echo "</tr>";
                                        }
                                    } else {
                                        // Menampilkan baris jika tidak ada data
                                        $colspan = (trim($_SESSION['admin_role']) === 'superadmin') ? '6' : '5';
                                        echo "<tr>";
                                        echo "<td colspan='" . $colspan . "' class='px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center'>Tidak ada data admin</td>";
                                        echo "</tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php
                    // Menutup koneksi
                    $conn->close();
                    ?>

                </div>


                <!-- Modal backdrop. This what you want to place close to the closing body tag -->
                <div x-show="isModalOpen" x-transition:enter="transition ease-out duration-150"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-30 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
                    <!-- Modal -->
                    <form action="../controllers/insert_admin.php" method="POST" enctype="multipart/form-data">
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
                                    Tambah Admin
                                </p>
                                <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Nama</span>
                                        <input
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                            type="text" id="name" name="name" required placeholder="Nama" />
                                    </label>

                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Email</span>
                                        <input
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                            type="email" id="email" name="email" required
                                            placeholder="example@mail.com" />
                                    </label>

                                    <label class="block text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Password</span>
                                        <input
                                            class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                            type="password" id="password" name="password" required
                                            placeholder="Password" />
                                    </label>

                                    <label class="block mt-4 text-sm">
                                        <span class="text-gray-700 dark:text-gray-400">Role</span>
                                        <select name="role"
                                            class="block w-full mt-1 text-sm dark:text-gray-300 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                                            <option value="admin">admin</option>
                                            <option value="superadmin">superadmin</option>
                                        </select>
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