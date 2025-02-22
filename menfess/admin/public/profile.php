<?php
// Cek apakah ada parameter 'status' di URL
if (isset($_GET['status']) && isset($_GET['message'])) {
    $status = htmlspecialchars($_GET['status']);
    $message = htmlspecialchars($_GET['message']);
    echo "<script>
        var status = '$status';
        var message = '$message';
        
        if (status === 'success') {
            alert('Success: ' + message);
        } else if (status === 'error') {
            alert('Error: ' + message);
        }
    </script>";
}
?>


<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile - IDM</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="./assets/css/tailwind.output.css" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="./assets/js/init-alpine.js"></script>
</head>

<body>
    <div class="flex h-screen bg-gray-50 dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen}">
        <!-- Desktop sidebar -->
        <?php include 'session.php'; ?>
        <?php include 'aside.php'; ?>

        <div class="flex flex-col flex-1">
            <?php include 'header.php'; ?>
            <main class="h-full overflow-y-auto">
                <div class="container px-6 mx-auto grid">
                    <!-- Profile cards -->
                    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
                        Profile
                    </h2>
                    <!-- Divs are used just to display the examples. Use only the button. -->
                    <a class="flex items-center justify-between p-4 mb-8 text-sm font-semibold text-purple-100 bg-purple-600 rounded-lg shadow-md focus:outline-none focus:shadow-outline-purple"
                        href="editprofile">
                        <div class="flex items-center">
                            <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                                </path>
                            </svg>
                            <span>Edit Your Profile</span>
                        </div>
                        <span>Edit &RightArrow;</span>
                    </a>

                    <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-6">
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div
                                class="p-3 mr-4 text-orange-500 bg-orange-100 rounded-full dark:text-orange-100 dark:bg-orange-500">
                                <img src="" alt="">
                            </div>
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    <?php echo htmlspecialchars($admin_name); ?>
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    <?php echo htmlspecialchars($admin_email); ?>
                                </p>
                            </div>
                        </div>
                        <!-- Card -->
                        <div class="flex items-center p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
                            <div>
                                <p class="mb-2 text-sm font-medium text-gray-600 dark:text-gray-400">
                                    Role
                                </p>
                                <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                                    <?php echo htmlspecialchars($admin_role); ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <?php
                    // Include file koneksi
                    require_once '../controllers/koneksi.php';

                    // Mulai sesi
                    session_start();

                    // Cek apakah admin ID ada di sesi
                    if (!isset($_SESSION['admin_id'])) {
                        echo "Admin ID tidak ditemukan di sesi.";
                        exit();
                    }

                    $adminId = $_SESSION['admin_id'];
                    $itemsPerPage = 10;

                    // Pastikan halaman adalah angka positif dan minimal 1
                    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                    if ($page < 1) {
                        $page = 1;
                    }

                    $offset = ($page - 1) * $itemsPerPage;

                    // Hitung total aktivitas
                    $totalSql = "SELECT COUNT(*) as total FROM `history` WHERE `admin_id` = ?";
                    $totalStmt = $conn->prepare($totalSql);
                    $totalStmt->bind_param("i", $adminId);
                    $totalStmt->execute();
                    $totalResult = $totalStmt->get_result();
                    $totalRow = $totalResult->fetch_assoc();
                    $totalItems = $totalRow['total'];
                    $totalPages = ceil($totalItems / $itemsPerPage);

                    $totalStmt->close();

                    // Query untuk mengambil data aktivitas
                    $sql = "SELECT `id`, `admin_id`, `action_type`, `action_details`, `created_at`
        FROM `history`
        WHERE `admin_id` = ?
        ORDER BY `created_at` DESC
        LIMIT ?
        OFFSET ?";
                    $stmt = $conn->prepare($sql);

                    if (!$stmt) {
                        die("Error preparing statement: " . $conn->error);
                    }

                    $stmt->bind_param("iii", $adminId, $itemsPerPage, $offset);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    ?>



                    <!-- HTML for Activity History -->
                    <div class="grid gap-6 mb-8 md:grid-cols-1 xl:grid-cols-12">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4 dark:text-gray-200">Riwayat Aktivitas</h2>
                        <div id="activityHistory" class="space-y-4">
                            <?php
                            if ($result && $result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    // Format tanggal
                                    $dateTime = new DateTime($row['created_at']);
                                    $formattedDate = $dateTime->format('l, d F Y  [H:i');

                                    $details = htmlspecialchars($row['action_details']);

                                    echo "<div class='activity-item p-4 bg-gray-50 rounded-lg shadow-sm border border-gray-200 dark:bg-gray-900'>";
                                    echo "<p class='font-semibold text-gray-800 dark:text-gray-200'>$formattedDate WIB]</p>";
                                    echo "<p class='text-gray-600 dark:text-gray-200'>$details</p>";
                                    echo "</div>";
                                }
                            } else {
                                echo "<div class='p-4 bg-gray-50 rounded-lg shadow-sm border border-gray-200'>";
                                echo "<p class='text-gray-600'>Tidak ada riwayat aktivitas</p>";
                                echo "</div>";
                            }
                            ?>
                        </div>

                        <!-- Pagination Controls -->
                        <div id="paginationControls" class="mt-4 flex justify-between items-center">
                            <button id="prevPage"
                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 dark:text-gray-200"
                                <?php if ($page <= 1): ?>disabled<?php endif; ?>>
                                &larr;
                            </button>
                            <span id="pageInfo" class="text-gray-600 dark:text-gray-200">
                                <?php echo htmlspecialchars($page); ?> dari
                                <?php echo htmlspecialchars($totalPages); ?></span>
                            <button id="nextPage"
                                class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md hover:bg-gray-300 dark:text-gray-200"
                                <?php if ($page >= $totalPages): ?>disabled<?php endif; ?>>
                                &rarr;
                            </button>
                        </div>
                    </div>



                    <?php
                    // Menutup koneksi
                    $stmt->close();
                    $conn->close();
                    ?>
                </div>
            </main>
        </div>
    </div>
</body>

</html>