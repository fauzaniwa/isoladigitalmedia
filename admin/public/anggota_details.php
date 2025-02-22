<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Details Anggota - IDM</title>
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
                        $sql = "SELECT * FROM anggota WHERE id = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Periksa apakah data ditemukan
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $name = htmlspecialchars($row['name']);
                            $nim = htmlspecialchars($row['nim']);
                            $tahunangkatan = htmlspecialchars($row['tahunangkatan']);
                            $programstudi = htmlspecialchars($row['programstudi']);
                            $Instagram = htmlspecialchars($row['Instagram']);
                            $nohp = htmlspecialchars($row['nohp']);
                            $portfolio = htmlspecialchars($row['portfolio']);
                            $cv = htmlspecialchars($row['cv']);
                            $department = htmlspecialchars($row['department']);
                            $divisi = htmlspecialchars($row['divisi']);
                            $opsi_department = htmlspecialchars($row['opsi_department']);
                            $opsi_divisi = htmlspecialchars($row['opsi_divisi']);
                            $knowledge = htmlspecialchars($row['knowledge']);
                            $username = htmlspecialchars($row['username']);
                            $pindah_divisi = htmlspecialchars($row['pindah_divisi']);
                            $setuju = htmlspecialchars($row['setuju']);
                            $email = htmlspecialchars($row['email']);
                            $status = htmlspecialchars($row['status']);
                            $created_at = htmlspecialchars($row['created_at']);
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
                    <?php
                    include '../controllers/koneksi.php';

                    // Ambil data anggota berdasarkan ID
                    $id_anggota = $_GET['id'] ?? 0;
                    $sql = "SELECT `status`, `sebagai` FROM `anggota` WHERE `id` = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $id_anggota);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $anggota = $result->fetch_assoc();
                    $current_status = $anggota['status'] ?? 'pending';
                    $current_sebagai = $anggota['sebagai'] ?? 'pending'; // Default ke 'pending' jika tidak ada data
                    ?>

                    <form action="../controllers/update_draft.php" method="POST" enctype="multipart/form-data">
                        <!-- Pastikan ID dikirim untuk update -->

                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Nama : </span>
                                <span class="text-gray-700 dark:text-gray-400"><?php echo $name; ?></span>
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">NIM : </span>
                                <span class="text-gray-700 dark:text-gray-400"><?php echo $nim; ?></span>
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Angkatan : </span>
                                <span class="text-gray-700 dark:text-gray-400"><?php echo $tahunangkatan; ?></span>
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Program Studi : </span>
                                <span class="text-gray-700 dark:text-gray-400"><?php echo $programstudi; ?></span>
                            </label>
                        </div>

                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Email : </span>
                                <span class="text-gray-700 dark:text-gray-400"><?php echo $email; ?></span>
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Username : </span>
                                <span class="text-gray-700 dark:text-gray-400"><?php echo $username; ?></span>
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">No. HP : </span>
                                <span class="text-gray-700 dark:text-gray-400"><?php echo $nohp; ?></span>
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Instagram : </span>
                                <span class="text-gray-700 dark:text-gray-400"><?php echo $Instagram; ?></span>
                            </label>
                        </div>

                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Apa yang kamu ketahui dari IDM : </span>
                                <span class="text-gray-700 dark:text-gray-400"><?php echo $knowledge; ?></span>
                            </label>
                        </div>
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Portfolio : </span>
                                <a href="<?php echo $portfolio; ?>"
                                    class="text-gray-700 dark:text-gray-400"><?php echo $portfolio; ?></a>
                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">CV : </span>
                                <a href="<?php echo $cv; ?>"
                                    class="text-gray-700 dark:text-gray-400"><?php echo $cv; ?></a>
                            </label>
                        </div>
                        <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Pindah Divisi : </span>
                                <?php
                                // Atur kelas berdasarkan kondisi pindah_posisi
                                $class = '';
                                if ($pindah_divisi === 'yes') {
                                    $class = 'text-green-700 bg-green-100 dark:bg-green-700 dark:text-green-100';
                                } elseif ($pindah_divisi === 'no') {
                                    $class = 'text-orange-700 bg-orange-100 dark:text-white dark:bg-orange-600';
                                } else {
                                    $class = 'text-gray-700 dark:text-gray-400'; // Kelas default jika tidak memenuhi kondisi
                                }
                                ?>

                                <span
                                    class="rounded-full px-2 py-1 font-semibold leading-tight <?php echo $class; ?>"><?php echo $pindah_divisi; ?></span>

                            </label>
                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Opsi 1</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    type="text" id="nama_draft" name="nama_draft" required placeholder="Judul Draft"
                                    value="Department <?php echo $department; ?>" />
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    type="text" id="nama_draft" name="nama_draft" required placeholder="Judul Draft"
                                    value="Divisi <?php echo $divisi; ?>" />
                            </label>

                            <label class="block text-sm">
                                <span class="text-gray-700 dark:text-gray-400">Opsi 2</span>
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    type="text" id="nama_draft" name="nama_draft" required placeholder="Judul Draft"
                                    value="Department <?php echo $opsi_department; ?>" />
                                <input
                                    class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                    type="text" id="nama_draft" name="nama_draft" required placeholder="Judul Draft"
                                    value="Divisi <?php echo $opsi_divisi; ?>" />
                            </label>

                        </div>
                        <!-- HTML untuk menampilkan dan mengubah status -->
                        <div class="mt-4 text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Status</span>
                            <div class="mt-2">
                                <label class="inline-flex items-center text-gray-600 dark:text-gray-400">
                                    <input type="radio"
                                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="accountType" value="pending" <?= $current_status === 'pending' ? 'checked' : '' ?> onclick="updateStatus('pending')" />
                                    <span class="ml-2">Pending</span>
                                </label>
                                <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                    <input type="radio"
                                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="accountType" value="wawancara" <?= $current_status === 'wawancara' ? 'checked' : '' ?> onclick="updateStatus('wawancara')" />
                                    <span class="ml-2">Wawancara</span>
                                </label>
                                <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                    <input type="radio"
                                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="accountType" value="ditolak" <?= $current_status === 'ditolak' ? 'checked' : '' ?> onclick="updateStatus('ditolak')" />
                                    <span class="ml-2">Tolak</span>
                                </label>
                                <label class="inline-flex items-center ml-6 text-gray-600 dark:text-gray-400">
                                    <input type="radio"
                                        class="text-purple-600 form-radio focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray"
                                        name="accountType" value="diterima" <?= $current_status === 'diterima' ? 'checked' : '' ?> onclick="updateStatus('diterima')" />
                                    <span class="ml-2">Terima</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-col dark:text-gray-400">
                            <label for="sebagai" class="mb-2 text-sm font-medium">Pada Posisi :</label>
                            <select name="sebagai" id="sebagai"
                                class="px-4 py-2 border rounded-lg bg-white dark:bg-gray-800 dark:border-gray-600"
                                onchange="updateSebagai(this.value)">
                                <option value="pending" <?= is_null($current_sebagai) || $current_sebagai === 'pending' ? 'selected' : '' ?> disabled>Pilihan
                                </option>
                                <option
                                    value="Departement <?php echo htmlspecialchars($department); ?>, Divisi <?php echo htmlspecialchars($divisi); ?>"
                                    <?= $current_sebagai === "Departement " . htmlspecialchars($department) . ", Divisi " . htmlspecialchars($divisi) ? 'selected' : '' ?>>
                                    Pilihan 1 : <?php echo htmlspecialchars($department); ?>,
                                    <?php echo htmlspecialchars($divisi); ?>
                                </option>
                                <option
                                    value="Departement <?php echo htmlspecialchars($opsi_department); ?>, Divisi <?php echo htmlspecialchars($opsi_divisi); ?>"
                                    <?= $current_sebagai === "Departement " . htmlspecialchars($opsi_department) . ", Divisi " . htmlspecialchars($opsi_divisi) ? 'selected' : '' ?>>
                                    Pilihan 2 : <?php echo htmlspecialchars($opsi_department); ?>,
                                    <?php echo htmlspecialchars($opsi_divisi); ?>
                                </option>
                            </select>

                        </div>


                        <footer>
                            <a type="button" href="anggota"
                                class="w-full px-5 py-3 text-sm font-medium leading-5 text-white text-gray-700 transition-colors duration-150 border border-gray-300 rounded-lg dark:text-gray-400 sm:px-4 sm:py-2 sm:w-auto active:bg-transparent hover:border-gray-500 focus:border-gray-500 active:text-gray-500 focus:outline-none focus:shadow-outline-gray">
                                Back
                            </a>
                        </footer>
                    </form>
            </main>
        </div>
    </div>
    <script>
        function updateStatus(status) {
            var id = <?= json_encode($id_anggota) ?>; // ID anggota dari PHP

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_status.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Opsional: tangani respons dari server jika diperlukan
                    console.log(xhr.responseText);
                }
            };

            xhr.send("id=" + id + "&status=" + status);
        }

        function updateSebagai(sebagai) {
            var id = <?= json_encode($id_anggota) ?>; // ID anggota dari PHP

            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_sebagai.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Opsional: tangani respons dari server jika diperlukan
                    console.log(xhr.responseText);
                }
            };

            xhr.send("id=" + id + "&sebagai=" + sebagai);
        }
    </script>

</body>

</html>