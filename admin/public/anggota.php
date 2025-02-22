<?php
// Cek apakah ada parameter status di URL
if (isset($_GET['status'])) {
    $status = $_GET['status'];

    if ($status == 'success') {
        echo "<script>alert('Berhasil menambahkan anggota!');</script>";
    } elseif ($status == 'error') {
        echo "<script>alert('Gagal menambahkan anggota!');</script>";
    } elseif ($status == 'success_delete') {
        echo "<script>alert('Berhasil menghapus anggota!');</script>";
    } elseif ($status == 'error_delete') {
        echo "<script>alert('Gagal menghapus anggota!');</script>";
    } elseif ($status == 'success_update') {
        echo "<script>alert('Berhasil update anggota!');</script>";
    } elseif ($status == 'error_update') {
        echo "<script>alert('Gagal update anggota!');</script>";
    }
}
?>

<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Anggota - IDM</title>
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
                        Anggota
                    </h2>

                    <?php
                    include '../controllers/koneksi.php';

                    // Ambil parameter dari URL atau POST
                    $sort = isset($_GET['sort']) ? $_GET['sort'] : 'newest'; // Default sort by newest
                    $filter_divisi = isset($_GET['filter_divisi']) ? $_GET['filter_divisi'] : '';
                    $filter_opsi_divisi = isset($_GET['filter_opsi_divisi']) ? $_GET['filter_opsi_divisi'] : ''; // Tambahan filter opsi divisi
                    $filter_programstudi = isset($_GET['filter_programstudi']) ? $_GET['filter_programstudi'] : '';
                    $search_name = isset($_GET['search_name']) ? $_GET['search_name'] : '';

                    // Tentukan klausa WHERE berdasarkan filter
                    $whereClauses = [];
                    if ($filter_divisi) {
                        $whereClauses[] = "divisi = '" . $conn->real_escape_string($filter_divisi) . "'";
                    }
                    if ($filter_opsi_divisi) { // Tambahan filter opsi divisi
                        $whereClauses[] = "opsi_divisi = '" . $conn->real_escape_string($filter_opsi_divisi) . "'";
                    }
                    if ($filter_programstudi) {
                        $whereClauses[] = "programstudi = '" . $conn->real_escape_string($filter_programstudi) . "'";
                    }
                    if ($search_name) {
                        $whereClauses[] = "name LIKE '%" . $conn->real_escape_string($search_name) . "%'";
                    }
                    $whereSql = implode(' AND ', $whereClauses);

                    // Tentukan klausa ORDER BY berdasarkan sort
                    $orderBy = ($sort === 'newest') ? 'created_at DESC' : 'created_at ASC';

                    // Buat query SQL
                    $sql = "SELECT `id`, `name`, `nim`, `programstudi`, `department`, `divisi`, `opsi_department`, `opsi_divisi`, `pindah_divisi`, `status`
        FROM `anggota`
        " . ($whereSql ? "WHERE $whereSql" : "") . "
        ORDER BY $orderBy";
                    $result = $conn->query($sql);
                    ?>


                    <!-- Form untuk Filter dan Sort -->
                    <div class="w-full overflow-hidden rounded-lg shadow-xs p-4 dark:text-gray-200">
                        <form method="get" action=""
                            class="flex flex-col flex-wrap mb-4 space-y-4 md:flex-row md:items-end md:space-x-4">
                            <!-- Sorting -->
                            
                            <div class="flex flex-col">
                                <label for="sort" class="mb-2 text-sm font-medium">Sort by:</label>
                                <select name="sort" id="sort"
                                    class="px-4 py-2 border rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600">
                                    <option value="newest" <?= $sort === 'newest' ? 'selected' : '' ?>>Newest</option>
                                    <option value="oldest" <?= $sort === 'oldest' ? 'selected' : '' ?>>Oldest</option>
                                </select>
                            </div>

                            <!-- Filter Program Studi -->
                            <div class="flex flex-col">
                                <label for="filter_programstudi" class="mb-2 text-sm font-medium">Program Studi:</label>
                                <select name="filter_programstudi" id="filter_programstudi"
                                    class="px-4 py-2 border rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600">
                                    <option value="" <?= empty($filter_programstudi) ? 'selected' : '' ?>>Pilih Program
                                        Studi</option>
                                    <option value="Desain Komunikasi Visual" <?= $filter_programstudi === 'Desain Komunikasi Visual' ? 'selected' : '' ?>>Desain Komunikasi Visual</option>
                                    <option value="Film dan Televisi" <?= $filter_programstudi === 'Film dan Televisi' ? 'selected' : '' ?>>Film dan Televisi</option>
                                    <option value="Musik" <?= $filter_programstudi === 'Musik' ? 'selected' : '' ?>>Musik
                                    </option>
                                    <option value="Pendidikan Seni Rupa" <?= $filter_programstudi === 'Pendidikan Seni Rupa' ? 'selected' : '' ?>>Pendidikan Seni Rupa</option>
                                    <option value="Pendidikan Seni Tari" <?= $filter_programstudi === 'Pendidikan Seni Tari' ? 'selected' : '' ?>>Pendidikan Seni Tari</option>
                                    <option value="Pendidikan Seni Musik" <?= $filter_programstudi === 'Pendidikan Seni Musik' ? 'selected' : '' ?>>Pendidikan Seni Musik</option>
                                </select>
                            </div>

                            <!-- Filter Divisi -->
                            <div class="flex flex-col">
                                <label for="filter_divisi" class="mb-2 text-sm font-medium">Divisi:</label>
                                <select name="filter_divisi" id="filter_divisi"
                                    class="px-4 py-2 border rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600">
                                    <option value="" <?= empty($filter_divisi) ? 'selected' : '' ?>>Pilih Divisi</option>
                                    <option value="Graphic Design" <?= $filter_divisi === 'Graphic Design' ? 'selected' : '' ?>>Graphic Design</option>
                                    <option value="Ilustrasi" <?= $filter_divisi === 'Ilustrasi' ? 'selected' : '' ?>>
                                        Ilustrasi</option>
                                    <option value="Komik" <?= $filter_divisi === 'Komik' ? 'selected' : '' ?>>Komik
                                    </option>
                                    <option value="UI/UX" <?= $filter_divisi === 'UI/UX' ? 'selected' : '' ?>>UI/UX
                                    </option>
                                    <option value="Animasi" <?= $filter_divisi === 'Animasi' ? 'selected' : '' ?>>Animasi
                                    </option>
                                    <option value="3D" <?= $filter_divisi === '3D' ? 'selected' : '' ?>>3D</option>
                                    <option value="Game Asset" <?= $filter_divisi === 'Game Asset' ? 'selected' : '' ?>>
                                        Game Asset</option>
                                    <option value="Game Programmer" <?= $filter_divisi === 'Game Programmer' ? 'selected' : '' ?>>Game Programmer</option>
                                    <option value="Fotografi" <?= $filter_divisi === 'Fotografi' ? 'selected' : '' ?>>
                                        Fotografi</option>
                                    <option value="Sinematik" <?= $filter_divisi === 'Sinematik' ? 'selected' : '' ?>>
                                        Sinematik</option>
                                </select>
                            </div>

                            <!-- Filter Opsi Divisi -->
                            <div class="flex flex-col mt-4">
                                <label for="filter_opsi_divisi" class="mb-2 text-sm font-medium">Opsi Divisi:</label>
                                <select name="filter_opsi_divisi" id="filter_opsi_divisi"
                                    class="px-4 py-2 border rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600">
                                    <option value="" <?= empty($filter_opsi_divisi) ? 'selected' : '' ?>>Pilih Opsi
                                        Divisi</option>
                                    <option value="Graphic Design" <?= $filter_opsi_divisi === 'Graphic Design' ? 'selected' : '' ?>>Graphic Design</option>
                                    <option value="Ilustrasi" <?= $filter_opsi_divisi === 'Ilustrasi' ? 'selected' : '' ?>>
                                        Ilustrasi</option>
                                    <option value="Komik" <?= $filter_opsi_divisi === 'Komik' ? 'selected' : '' ?>>Komik
                                    </option>
                                    <option value="UI/UX" <?= $filter_opsi_divisi === 'UI/UX' ? 'selected' : '' ?>>UI/UX
                                    </option>
                                    <option value="Animasi" <?= $filter_opsi_divisi === 'Animasi' ? 'selected' : '' ?>>
                                        Animasi</option>
                                    <option value="3D" <?= $filter_opsi_divisi === '3D' ? 'selected' : '' ?>>3D</option>
                                    <option value="Game Asset" <?= $filter_opsi_divisi === 'Game Asset' ? 'selected' : '' ?>>Game Asset</option>
                                    <option value="Game" <?= $filter_opsi_divisi === 'Game' ? 'selected' : '' ?>>Game
                                    </option>
                                    <option value="Fotografi" <?= $filter_opsi_divisi === 'Fotografi' ? 'selected' : '' ?>>
                                        Fotografi</option>
                                    <option value="Sinematik" <?= $filter_opsi_divisi === 'Sinematik' ? 'selected' : '' ?>>
                                        Sinematik</option>
                                </select>
                            </div>




                            <!-- Search -->
                            <div class="flex flex-col col-span-1 md:col-span-2 lg:col-span-3 xl:col-span-5">
                                <label for="search_name" class="mb-2 text-sm font-medium">Search by Name:</label>
                                <input type="text" name="search_name" id="search_name"
                                    value="<?= htmlspecialchars($search_name); ?>"
                                    class="px-4 py-2 border rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600">
                            </div>

                            <button type="submit"
                                class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                                Apply
                            </button>
                        </form>
                        
<form action="../controllers/export_anggota.php" method="post">
    <button type="submit"
        class="px-3 py-1 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-md active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
        Download Excel
    </button>
</form>

                    </div>



                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <table class="w-full whitespace-no-wrap">
                                <thead>
                                    <tr
                                        class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b dark:border-gray-700 bg-gray-50 dark:text-gray-400 dark:bg-gray-800">
                                        <th class="px-4 py-3">No.</th>
                                        <th class="px-4 py-3">Nama</th>
                                        <th class="px-4 py-3">Program Studi</th>
                                        <th class="px-4 py-3">Pilihan 1</th>
                                        <th class="px-4 py-3">Pilihan 2</th>
                                        <th class="px-4 py-3">Dipindahkan</th>
                                        <th class="px-4 py-3">Status</th>
                                        <th class="px-4 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
                                    <?php if ($result->num_rows > 0): ?>
                                        <?php $no = 1; ?>
                                        <?php while ($row = $result->fetch_assoc()): ?>
                                            <tr class="text-gray-700 dark:text-gray-400">
                                                <td class="px-4 py-3 text-sm"><?= $no++; ?>.</td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div>
                                                            <p class="font-semibold"><?= htmlspecialchars($row['name']); ?></p>
                                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                                <?= htmlspecialchars($row['nim']); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3 text-sm">
                                                    <?= htmlspecialchars($row['programstudi']); ?>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div>
                                                            <p class="font-semibold">
                                                                <?= htmlspecialchars($row['department']); ?>
                                                            </p>
                                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                                <?= htmlspecialchars($row['divisi']); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-4 py-3">
                                                    <div class="flex items-center text-sm">
                                                        <div>
                                                            <p class="font-semibold">
                                                                <?= htmlspecialchars($row['opsi_department']); ?>
                                                            </p>
                                                            <p class="text-xs text-gray-600 dark:text-gray-400">
                                                                <?= htmlspecialchars($row['opsi_divisi']); ?>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td class="px-4 py-3 text-xs">
                                                    <span
                                                        class="px-2 py-1 font-semibold leading-tight <?= ($row['pindah_divisi'] == 'yes') ? 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100' : 'text-red-700 bg-red-100 dark:bg-red-700 dark:text-red-100'; ?> rounded-full">
                                                        <?= htmlspecialchars($row['pindah_divisi']); ?>
                                                    </span>
                                                </td>
                                                <td class="px-4 py-3 text-xs">
                                                    <?php
                                                    // Default values
                                                    $statusClass = 'text-gray-700 bg-gray-100 dark:text-gray-100 dark:bg-gray-700';
                                                    $statusText = 'Pending';

                                                    // Checking for different statuses
                                                    if ($row['status'] == 'diterima') {
                                                        $statusClass = 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100';
                                                        $statusText = 'Diterima';
                                                    } elseif ($row['status'] == 'ditolak') {
                                                        $statusClass = 'text-orange-700 bg-orange-100 dark:text-white dark:bg-orange-600';
                                                        $statusText = 'Ditolak';
                                                    } elseif ($row['status'] == 'wawancara') { // Add the new condition for 'wawancara'
                                                        $statusClass = 'text-yellow-700 bg-yellow-100 dark:text-yellow-100 dark:bg-yellow-600'; // Yellow color
                                                        $statusText = 'Wawancara'; // The text for this status
                                                    }
                                                    ?>

                                                    <span
                                                        class="px-2 py-1 font-semibold leading-tight <?= $statusClass ?> rounded-full">
                                                        <?= $statusText ?>
                                                    </span>
                                                </td>

                                                <td class="px-4 py-3">
                                                    <div class="flex items-center space-x-4 text-sm">
                                                        <!-- Edit Button -->
                                                        <a href="anggota_details?id=<?php echo htmlspecialchars($row['id']); ?>"
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
                                                        <form method="POST" action="../controllers/delete_anggota.php"
                                                            onsubmit="return confirm('Are you sure you want to delete this item?');">
                                                            <input type="hidden" name="id"
                                                                value="<?php echo htmlspecialchars($row['id']); ?>">
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
                                        <tr>
                                            <td colspan="8" class="px-4 py-3 text-center text-sm text-gray-500">No data
                                                available</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <?php
                    $conn->close();
                    ?>


                </div>
            </main>
        </div>
    </div>
</body>

</html>