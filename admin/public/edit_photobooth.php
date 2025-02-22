<!DOCTYPE html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Edit Photobooth - IDM</title>
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
                        Edit Photobooth
                    </h2>
                    <?php
                    // Ambil ID dari parameter URL
                    if (isset($_GET['id'])) {
                        $id = $_GET['id'];

                        // Koneksi ke database
                        include_once '../controllers/koneksi.php';

                        // Query untuk mengambil data photobooth berdasarkan ID
                        $sql = "SELECT * FROM photobooth WHERE id_photobooth = ?";
                        $stmt = $conn->prepare($sql);
                        $stmt->bind_param("i", $id);
                        $stmt->execute();
                        $result = $stmt->get_result();

                        // Periksa apakah data ditemukan
                        if ($result->num_rows > 0) {
                            $row = $result->fetch_assoc();
                            $nama = $row['nama'];
                            $whatsapp = $row['whatsapp'];
                            $email = $row['email'];
                            $style_art = $row['style_art'];
                            $frame_type = $row['frame_type'];
                            $total_order = $row['total_order'];
                            $img_real = $row['img_real'];
                            $img_art = $row['img_art'];
                            $order_status = $row['order_status'];
                            $payment_method = $row['payment_method'];
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

                    <form action="../controllers/update_photobooth.php" method="POST" enctype="multipart/form-data">
                        <!-- Pastikan ID dikirim untuk update -->
                        <input type="hidden" name="id_photobooth" value="<?php echo $id; ?>" />
                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Image Real</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                type="text" id="img_real" name="img_real" placeholder="Image Real URL"
                                value="<?php echo htmlspecialchars($img_real); ?>" disabled />
                        </label>
                        <img id="imgRealPreview"
                            src="<?php echo htmlspecialchars(!empty($img_real) ? 'src/filephotobooth/' . $img_real : 'https://media.istockphoto.com/id/1396814518/vector/image-coming-soon-no-photo-no-thumbnail-image-available-vector-illustration.jpg?s=612x612&w=0&k=20&c=hnh2OZgQGhf0b46-J2z7aHbIWwq8HNlSDaNp2wn_iko='); ?>"
                            alt="Image Real Preview" class="mt-2 w-32 h-32 object-cover border rounded cursor-pointer"
                            onclick="openFullscreen('imgRealPreview')">


                        <label class="block text-sm">
                            <span class="text-gray-700 dark:text-gray-400">Image Art</span>
                            <input
                                class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                type="file" id="img_art" name="img_art" accept="image/*"
                                onchange="previewImage(event, 'imgArtPreview')" />
                            <p class="dark:text-gray-300">File saat ini: <span
                                    id="currentImageArt"><?php echo htmlspecialchars($img_art); ?></span></p>
                        </label>
                        <img id="imgArtPreview"
                            src="<?php echo htmlspecialchars(!empty($img_art) ? 'src/filephotobooth/' . $img_art : 'https://media.istockphoto.com/id/1396814518/vector/image-coming-soon-no-photo-no-thumbnail-image-available-vector-illustration.jpg?s=612x612&w=0&k=20&c=hnh2OZgQGhf0b46-J2z7aHbIWwq8HNlSDaNp2wn_iko='); ?>"
                            alt="Image Art Preview" class="mt-2 w-32 h-32 object-cover border rounded cursor-pointer"
                            onclick="openFullscreen('imgArtPreview')">


                        <!-- Modal body -->
                        <div class="mt-4 mb-6">
                            <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Nama</span>
                                    <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="text" id="nama" disabled name="nama" required placeholder="Nama"
                                        value="<?php echo htmlspecialchars($nama); ?>" />
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">WhatsApp</span>
                                    <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="text" id="whatsapp" disabled name="whatsapp" required
                                        placeholder="WhatsApp" value="<?php echo htmlspecialchars($whatsapp); ?>" />
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Email</span>
                                    <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="email" id="email" disabled name="email" required placeholder="Email"
                                        value="<?php echo htmlspecialchars($email); ?>" />
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Style Art</span>
                                    <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="text" id="style_art" disabled name="style_art" required
                                        placeholder="Style Art" value="<?php echo htmlspecialchars($style_art); ?>" />
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Frame Type</span>
                                    <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="text" id="frame_type" disabled name="frame_type" required
                                        placeholder="Frame Type" value="<?php echo htmlspecialchars($frame_type); ?>" />
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Total Order</span>
                                    <input
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        type="number" id="total_order" disabled name="total_order" required
                                        placeholder="Total Order"
                                        value="<?php echo htmlspecialchars($total_order); ?>" />
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Order Status</span>
                                    <select
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        id="order_status" name="order_status">
                                        <option value="pending" <?php echo ($order_status == 'pending') ? 'selected' : ''; ?>>Pending</option>
                                        <option value="completed" <?php echo ($order_status == 'completed') ? 'selected' : ''; ?>>Completed</option>
                                        <option value="canceled" <?php echo ($order_status == 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                                    </select>
                                </label>

                                <label class="block text-sm">
                                    <span class="text-gray-700 dark:text-gray-400">Payment Method</span>
                                    <select
                                        class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
                                        id="payment_method" name="payment_method">
                                        <option value="qriss" <?php echo ($payment_method == 'qriss') ? 'selected' : ''; ?>>
                                            Qris</option>
                                        <option value="cash" <?php echo ($payment_method == 'cash') ? 'selected' : ''; ?>>
                                            Cash</option>
                                        <option value="bank_transfer" <?php echo ($payment_method == 'bank_transfer') ? 'selected' : ''; ?>>Bank Transfer</option>
                                    </select>
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
                </div>
            </main>

        </div>
    </div>

    <!-- Fullscreen Modal -->
    <div id="fullscreenModal"
        class="fixed top-0 left-0 w-full h-full bg-black bg-opacity-75 flex items-center justify-center hidden"
        style="z-index: 9999;">
        <div class="relative">
            <img id="fullscreenImage" src="" alt="Fullscreen Image" class="max-w-full max-h-full" />
            <a id="downloadLink" href="#" download
                class="absolute top-2 right-2 bg-white text-black px-3 py-1 rounded">Download</a>
            <button class="absolute top-2 left-2 text-white text-2xl" onclick="closeFullscreen()">×</button>
        </div>
    </div>


    <script>
        function previewImage(event, previewElementId) {
            const file = event.target.files[0];
            const preview = document.getElementById(previewElementId);

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result; // Update the src of the preview image
                };
                reader.readAsDataURL(file); // Read the file as a data URL
            } else {
                // If no file is selected, reset the preview to the default image
                preview.src = 'https://media.istockphoto.com/id/1396814518/vector/image-coming-soon-no-photo-no-thumbnail-image-available-vector-illustration.jpg?s=612x612&w=0&k=20&c=hnh2OZgQGhf0b46-J2z7aHbIWwq8HNlSDaNp2wn_iko=';
            }
        }

        function openFullscreen(imageId) {
            const image = document.getElementById(imageId);
            const fullscreenImage = document.getElementById('fullscreenImage');
            const downloadLink = document.getElementById('downloadLink');

            fullscreenImage.src = image.src; // Set the src of the fullscreen image to the clicked image
            downloadLink.href = image.src; // Set the download link to the image URL

            document.getElementById('fullscreenModal').classList.remove('hidden'); // Show the fullscreen modal
            adjustFullscreenImage(); // Adjust the size of the image to fit the screen
        }

        function closeFullscreen() {
            document.getElementById('fullscreenModal').classList.add('hidden'); // Hide the fullscreen modal
        }

        // Close the modal when the Esc key is pressed
        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeFullscreen();
            }
        });

        // Adjust the fullscreen image to fit within the viewport
        function adjustFullscreenImage() {
            const fullscreenImage = document.getElementById('fullscreenImage');
            const windowHeight = window.innerHeight;
            fullscreenImage.style.maxHeight = `${windowHeight * 0.9}px`; // Set maximum height to 90% of the viewport height
        }
    </script>

</body>

</html>