<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FessUp - Menfess</title>
    <link rel="icon" href="src/favicon.png" type="image/png">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="stylesmenfess.css">


</head>

<body class="bg-pink-light text-pink-main">

    <!-- Header -->
    <?php
    include 'navbar.php'; ?>

    <!-- Modal -->
    <div id="modalBackgroundInfo"
        class="fixed flex inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-10">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-700">Info</h2>
            </div>
            <!-- Pesan Dinamis -->
            <p id="modalMessage" class="text-gray-700 mb-4"></p>
            <!-- Close Button -->
            <div class="text-right">
                <button id="closeModalInfo"
                    class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg card-hover">
                    OK
                </button>
            </div>
        </div>
    </div>


    <!-- Modal Background -->
    <div id="modalBackground" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-10">
        <!-- Modal Content -->
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <!-- Modal Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-bold text-gray-700">Add Spotify Profile</h2>
                <button id="closeModal" class="text-gray-500 hover:text-gray-700">
                    &times;
                </button>
            </div>
            <!-- Modal Form -->
            <form action="../process/insert_mutual.php" method="POST">
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <input type="text" id="name" maxlength="10" name="name" required placeholder="Enter your name"
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Caption</label>
                    <input type="text" id="caption" maxlength="25" name="caption" required
                        placeholder="Enter your caption"
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
                <div class="mb-4">
                    <label for="spotifyLink" class="block text-gray-700 text-sm font-bold mb-2">Spotify Profile
                        Link</label>
                    <input type="url" id="spotifyLink" name="spotifyLink" required
                        placeholder="https://open.spotify.com/user/..."
                        class="appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
                <!-- Submit Button -->
                <div class="text-right">
                    <button type="submit"
                        class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg card-hover">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Floating Button -->
    <div class="floatingtoogle fixed bottom-6 right-6">
        <!-- Parent Button -->
        <button id="toggleMenu"
            class="bg-pink-600 text-white w-16 h-16 md:w-16 md:h-16 rounded-full shadow-lg flex justify-center items-center hover:bg-pink-700">
            <i class="bi bi-pencil-square text-2xl md:text-3xl"></i>
        </button>
        <div id="menuItems" class="hidden flex flex-col items-end gap-2 mt-2">
            <a href="submit" class="bg-white text-pink-600 px-4 py-2 rounded-md shadow-md hover:bg-pink-100">
                Create Menfess
            </a>
            <a href="submitmutual" class="bg-white text-pink-600 px-4 py-2 rounded-md shadow-md hover:bg-pink-100">
                Create Mutual
            </a>

        </div>
    </div>

    <section class="mt-12 px-4 flex-grow items-center justify-center">
        <form class="max-w-2xl mx-auto" method="GET" action="">
            <label for="default-search"
                class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="search" name="search" id="default-search"
                    class="block w-full p-4 ps-10 text-sm text-gray-900 rounded-lg bg-gray-50 border-2 border-gray-300 rounded-lg mb-4"
                    placeholder="Search Name or Username Instagram"
                    value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" />
                <button type="submit"
                    class="absolute end-2.5 bottom-2.5  text-sm px-4 py-2 btn-primary rounded-md font-semibold shadow-md hover:shadow-lg">
                    Search
                </button>
            </div>
        </form>
    </section>



    <!-- Spotify Mutual Section -->
<section class="py-10 bg-white">
    <div class="container mx-auto text-center">
        <h2 class="text-3xl font-extrabold text-center text-pink-main mb-10">Menfess</h2>
    </div>

    <div id="menfess-container"
        class="bg-[#EAB6E7] p-6 rounded-lg container mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
        include '../process/koneksi.php';

        // Ambil 10 data pertama
        $query = "
            SELECT 
                m.id, 
                m.name, 
                m.usernameig, 
                m.message, 
                m.music, 
                m.views, 
                m.created_at,
                COUNT(c.id) AS total_comments
            FROM menfess m
            LEFT JOIN comment c ON m.id = c.menfess_id
            GROUP BY m.id ORDER BY m.created_at DESC LIMIT 10";
        
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
                $id = htmlspecialchars($row['id']);
                $name = htmlspecialchars($row['name']);
                $name = strlen($name) > 15 ? substr($name, 0, 15) . "..." : $name;
                $usernameig = htmlspecialchars($row['usernameig'] ?? 'Anonymous');
                $message = htmlspecialchars($row['message']);
                $display_message = strlen($message) > 35 ? substr($message, 0, 35) . "..." : $message;

                $track_url = $row['music'];
                preg_match('/track\/([a-zA-Z0-9]+)/', $track_url, $matches);
                $track_id = $matches[1] ?? null;
                ?>
                <!-- Card link -->
                <a href="clicked.php?id=<?php echo $id; ?>" class="bg-white shadow-md rounded-md p-6 card-hover">
                    <p class="text-lg font-bold"><?php echo $name; ?></p>
                    <p class="flex items-center text-gray-600">
                        <i class="bi bi-instagram text-xl mr-2"></i><?php echo $usernameig; ?>
                    </p>
                    <p class="my-4 font-primary text-2xl"><?php echo $display_message; ?></p>

                    <?php if (!empty($track_id)): ?>
                        <div class="flex items-center">
                            <div class="w-12 h-12 overflow-hidden rounded-md mr-2">
                                <img id="track-thumbnail-<?php echo htmlspecialchars($track_id); ?>" src=""
                                    alt="Track Thumbnail" class="object-cover w-full h-full" />
                            </div>
                            <span id="track-title-<?php echo htmlspecialchars($track_id); ?>"
                                class="text-pink-main hover:underline">Loading...</span>
                        </div>
                        <script>
                            fetch('https://open.spotify.com/oembed?url=<?php echo urlencode("https://open.spotify.com/track/" . $track_id); ?>')
                                .then(response => response.json())
                                .then(data => {
                                    document.getElementById("track-title-<?php echo htmlspecialchars($track_id); ?>").textContent = data.title;
                                    document.getElementById("track-thumbnail-<?php echo htmlspecialchars($track_id); ?>").src = data.thumbnail_url;
                                })
                                .catch(error => console.error('Error fetching oEmbed data:', error));
                        </script>
                    <?php else: ?>
                        <p>No track available.</p>
                    <?php endif; ?>

                    <div class="flex justify-start gap-6 items-center mt-4">
                        <span class="flex items-center">
                            <i class="bi bi-eye mr-2"></i><?php echo htmlspecialchars($row['views'] ?? 0); ?>
                        </span>
                        <span class="flex items-center">
                            <i class="bi bi-chat-dots mr-2"></i><?php echo htmlspecialchars($row['total_comments'] ?? 0); ?>
                        </span>
                    </div>
                </a>
            <?php endwhile;
        else:
            echo "<p class='text-center text-white'>Tidak ada data ditemukan.</p>";
        endif;
        ?>
    </div>

    <div class="text-center mt-6">
        <button id="load-more" class="bg-pink-500 text-white px-6 py-2 rounded-lg shadow-md">View More</button>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let offset = 10; // Jumlah data yang sudah ditampilkan

    document.getElementById("load-more").addEventListener("click", function () {
        fetch("load_more.php?offset=" + offset)
            .then(response => response.text())
            .then(data => {
                if (data.trim() !== "") {
                    document.getElementById("menfess-container").insertAdjacentHTML("beforeend", data);
                    offset += 10; // Tambah offset agar data selanjutnya diambil
                } else {
                    document.getElementById("load-more").style.display = "none"; // Sembunyikan tombol jika tidak ada data lagi
                }
            })
            .catch(error => console.error("Error fetching more data:", error));
    });
});

</script>


    <section class="flex items-center justify-center text-center">
        <script async
            src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8851872691835002"
            crossorigin="anonymous"></script>
        <!-- Ads IDM 1 -->
        <ins class="adsbygoogle" style="display:block" data-ad-client="ca-pub-8851872691835002"
            data-ad-slot="3651954529" data-ad-format="auto" data-full-width-responsive="true"></ins>
        <script>
            (adsbygoogle = window.adsbygoogle || []).push({});
        </script>
    </section>



    <?php
    include 'footer.php';
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const heroSection = document.querySelector(".py-20");

            function createLove() {
                const love = document.createElement("div");
                love.classList.add("love");

                // Randomize size and position
                const size = Math.random() * 40 + 20; // Size between 20px and 60px
                love.style.width = `${size}px`;
                love.style.height = `${size}px`;
                love.style.left = `${Math.random() * 100}%`; // Random horizontal position
                love.style.animationDuration = `${Math.random() * 3 + 2}s`; // Animation duration 2-5s

                heroSection.appendChild(love);

                // Remove love after animation ends
                setTimeout(() => love.remove(), 5000);
            }

            // Generate love hearts every 500ms
            setInterval(createLove, 500);
        });
    </script>
    <script>
        const toggleButton = document.getElementById('toggleMenu');
        const menuItems = document.getElementById('menuItems');

        toggleButton.addEventListener('click', () => {
            // Toggle visibility of child buttons
            menuItems.classList.toggle('hidden');
        });
    </script>
    <!-- JavaScript for Modal -->
    <script>
        const openModalButton = document.getElementById('openModal');
        const closeModalButton = document.getElementById('closeModal');
        const modalBackground = document.getElementById('modalBackground');

        openModalButton.addEventListener('click', () => {
            modalBackground.classList.remove('hidden');
            modalBackground.classList.add('flex');
        });

        closeModalButton.addEventListener('click', () => {
            modalBackground.classList.add('hidden');
        });

        // Close modal when clicking outside the content
        modalBackground.addEventListener('click', (e) => {
            if (e.target === modalBackground) {
                modalBackground.classList.add('hidden');
            }
        });
    </script>
    <script>
        // Cek jika ada pesan di URL
        const urlParams = new URLSearchParams(window.location.search);
        const message = urlParams.get('message');

        if (message) {
            // Tampilkan modal dengan pesan
            document.getElementById('modalBackgroundInfo').classList.remove('hidden');
            document.getElementById('modalMessage').textContent = message;
        }

        // Tutup modal
        document.getElementById('closeModalInfo').addEventListener('click', () => {
            document.getElementById('modalBackgroundInfo').classList.add('hidden');
            // Hapus parameter URL
            const cleanUrl = window.location.origin + window.location.pathname;
            window.history.replaceState(null, null, cleanUrl);
        });
    </script>

    <!-- JavaScript for Toggle Navbar -->
    <script>
        const navToggle = document.getElementById('navToggle');
        const navMenuMobile = document.getElementById('navMenuMobile');

        navToggle.addEventListener('click', () => {
            navMenuMobile.classList.toggle('hidden');
        });
    </script>

</body>

</html>