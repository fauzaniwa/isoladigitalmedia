<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FessUp - Clicked</title>
  <link rel="icon" href="src/favicon.png" type="image/png">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="stylesmenfess.css">

<!-- Open Graph Meta Tags (Facebook, LinkedIn, etc.) -->
<meta property="og:title" content="FessUp Isola Digital Media">
<meta property="og:description" content="Kirim Menfess seru atau temukan teman baru lewat Mutualan Spotify – bikin akhir tahunmu makin vibes di Isola Digital Media!">
<meta property="og:image" content="https://register.isoladigitalmedia.com/public/assets/img/idmlogo.jpg">
<meta property="og:url" content="https://menfess.isoladigitalmedia.com/">
<meta property="og:type" content="website">
<meta property="og:site_name" content="FessUp Isola Digital Media">

<!-- Twitter Card Meta Tags -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="FessUp Isola Digital Media">
<meta name="twitter:description" content="Kirim Menfess seru atau temukan teman baru lewat Mutualan Spotify – bikin akhir tahunmu makin vibes di Isola Digital Media!">
<meta name="twitter:image" content="https://register.isoladigitalmedia.com/public/assets/img/idmlogo.jpg">
<meta name="twitter:url" content="https://menfess.isoladigitalmedia.com/">
</head>

<body class="bg-pink-light text-pink-main">

  <!-- Header -->
  <?php
  include 'navbar.php'; ?>
  <!-- Create Button -->
  <div class="py-10 mx-6 flex-grow items-center justify-center">
    <button onclick="history.back()" class="p-6 font-semibold">
      <i class="bi bi-arrow-left text-xl"></i> Back / Menfess
    </button>
  </div>

  <!-- Detail Section -->
  <div id="modalBackground" class="fixed flex inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-10">

    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
      <!-- Modal Header -->
      <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-700">Add Comment</h2>
      </div>
      <p class="text-gray-700 mb-4">Komentar berhasil dikirim!</p>
      <!-- Close Button -->
      <div class="text-right">
        <button id="closeModal"
          class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg card-hover">
          OK
        </button>
      </div>
    </div>
  </div>


  <?php
  include '../process/koneksi.php';

  // Cek apakah ID telah diterima melalui URL
  if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data menfess sekaligus menghitung total komentar
    $query = "
      SELECT 
          m.id, 
          m.name, 
          m.usernameig, 
          m.message, 
          m.music, 
          m.views, 
          m.comment, 
          m.created_at,
          COUNT(c.id) AS total_comments
      FROM menfess m
      LEFT JOIN comment c ON m.id = c.menfess_id
      WHERE m.id = ? 
      GROUP BY m.id
  ";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Cek apakah data ditemukan
    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      // Ambil data dari database
      $name = htmlspecialchars($row['name']);
      $usernameig = htmlspecialchars($row['usernameig']);
      $message = htmlspecialchars($row['message']);
      $created_at = htmlspecialchars($row['created_at']);
      $views = htmlspecialchars($row['views']);
      $total_comments = htmlspecialchars($row['total_comments']);

      // Update views dengan menambah 1
      $new_views = $views + 1;

      // Query untuk memperbarui jumlah views
      $update_query = "
          UPDATE menfess 
          SET views = ? 
          WHERE id = ?
      ";

      $update_stmt = mysqli_prepare($conn, $update_query);
      mysqli_stmt_bind_param($update_stmt, 'ii', $new_views, $id);
      mysqli_stmt_execute($update_stmt);

      // Format tanggal
      $date = new DateTime($created_at);
      $formatted_date = $date->format('l, d F Y'); // Contoh: Rabu, 13 November 2024
  
      // Proses URL musik dan ambil ID track
      $track_url = $row['music'];
      preg_match('/track\/([a-zA-Z0-9]+)/', $track_url, $matches);
      $track_id = $matches[1] ?? $track_url;
    } else {
      echo "<p>Data tidak ditemukan untuk ID tersebut.</p>";
      exit;
    }
  } else {
    echo "<p>ID tidak disediakan dalam URL.</p>";
    exit;
  }
  ?>

  <section id="menfess-detail" class="py-20 bg-pink-light">
    <div class="container mx-auto text-center gap-6">
      <!-- Menfess Detail -->
      <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
        <p class="text-2xl mt-4 font-bold"><?php echo $name; ?></p>
        <?php
        // Hapus karakter '@' dari awal string, jika ada
        $usernameig = ltrim($usernameig, '@');
        ?>
        <p class="text-lg mb-6">
          <i class="bi bi-instagram text-xl mr-2"></i>
          <a target="_blank" href="https://www.instagram.com/<?php echo $usernameig; ?>">
            @<?php echo $usernameig; ?>
          </a>
        </p>

        <!-- Song Info -->
        <div class="w-full max-w-md mx-auto mb-6">
          <!-- Embed Spotify music dengan ID track -->
          <!-- Embed Spotify music dengan ID track -->
          <?php if (!empty($track_id)): ?>
            <iframe class="w-full h-48 border-0 rounded-lg" style="border-radius: 12px"
              src="https://open.spotify.com/embed/track/<?php echo $track_id; ?>?utm_source=generator" frameborder="0"
              allowfullscreen="" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
              loading="lazy"></iframe>
          <?php else: ?>
            <p>Track ID tidak tersedia.</p>
          <?php endif; ?>
        </div>

        <p class="my-4 font-primary text-2xl md:text-5xl">
          <?php echo $message; ?>
        </p>

        <p class="text-gray-600 py-10">
          <?php echo $formatted_date; ?>
        </p>

        <?php
        // Ambil URL halaman saat ini
        $current_url = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        // Pesan yang akan dibagikan
        $share_message = $message . "\n\n" .
          "✨ Baca selengkapnya di sini: $current_url\n" .
          "Kirim Menfess kamu sekarang di IDM Menfess dan buat momen seru! 🎉\n" .
          "Yuk, bagi pesan rahasia atau curhat seru kamu di halaman submit!";
        
        ?>


        <!-- Share Buttons -->
        <div class="flex justify-center space-x-4 mt-6">
          <!-- Share to WhatsApp -->
          <a href="https://wa.me/?text=<?php echo urlencode($share_message); ?>" target="_blank"
            class="btn-primary w-12 h-12 flex items-center justify-center rounded-full shadow-md hover:shadow-lg">
            <i class="bi bi-whatsapp text-xl text-white"></i>
          </a>

          <!-- Share to Twitter -->
          <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode($share_message); ?>" target="_blank"
            class="btn-primary w-12 h-12 flex items-center justify-center rounded-full shadow-md hover:shadow-lg">
            <i class="bi bi-twitter text-xl text-white"></i>
          </a>

          <!-- Share to Facebook -->
          <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($current_url); ?>" target="_blank"
            class="btn-primary w-12 h-12 flex items-center justify-center rounded-full shadow-md hover:shadow-lg">
            <i class="bi bi-facebook text-xl text-white"></i>
          </a>

          <!-- Download -->
          <button id="download-btn"
            class="btn-primary w-12 h-12 flex items-center justify-center rounded-full shadow-md hover:shadow-lg">
            <i class="bi bi-download text-xl text-white"></i>
          </button>
        </div>
        <p class="text-gray-600 mt-4">Share this on Social media</p>


      </div>
    </div>
  </section>

<section class="flex items-center justify-center text-center">
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-8851872691835002" crossorigin="anonymous"></script>
    <!-- Ads IDM 1 -->
    <ins class="adsbygoogle"
        style="display:block"
        data-ad-client="ca-pub-8851872691835002"
        data-ad-slot="3651954529"
        data-ad-format="auto"
        data-full-width-responsive="true"></ins>
    <script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
</section>

  <!-- Comment Section -->
<section class="bg-pink-light mb-6">
    <div class="container mx-auto text-left">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <!-- Statistics -->
            <div class="flex justify-start items-center mt-4 gap-6 text-gray-600">
                <span class="flex items-center">
                    <i class="bi bi-eye mr-2"></i> <?php echo $views; ?> Views
                </span>
                <span class="flex items-center">
                    <i class="bi bi-chat-dots mr-2"></i> <?php echo $total_comments; ?> Comments
                </span>
            </div>

            <h3 class="text-3xl font-semibold text-pink-main mb-6">Comments</h3>

            <?php
            // Periksa apakah can_comment = 1 untuk ID menfess
            $query_check_comment = "SELECT can_comment FROM menfess WHERE id = ?";
            $stmt_check_comment = mysqli_prepare($conn, $query_check_comment);
            mysqli_stmt_bind_param($stmt_check_comment, 'i', $id);
            mysqli_stmt_execute($stmt_check_comment);
            $result_check_comment = mysqli_stmt_get_result($stmt_check_comment);

            $can_comment = 0; // Default nilai jika tidak ditemukan
            if ($row = mysqli_fetch_assoc($result_check_comment)) {
                $can_comment = $row['can_comment'];
            }

            if ($can_comment == 1):
                ?>
                <!-- Comment Form -->
                <form method="POST" action="add_comment.php" class="mb-6">
                    <textarea name="content" class="w-full p-4 border-2 border-gray-300 rounded-lg mb-4" rows="4"
                        placeholder="Add a comment..." required></textarea>
                    <input type="hidden" name="menfess_id" value="<?php echo $id; ?>">
                    <button type="submit"
                        class="btn-primary text-white px-8 py-3 rounded-md font-semibold shadow-md hover:shadow-lg">
                        Submit Comment
                    </button>
                </form>

                <?php
                // Query untuk mengambil komentar berdasarkan ID menfess
                $query_comments = "
                    SELECT IP_Sender, username, content, created_at 
                    FROM comment 
                    WHERE menfess_id = ? 
                    ORDER BY created_at ASC";
                $stmt_comments = mysqli_prepare($conn, $query_comments);
                mysqli_stmt_bind_param($stmt_comments, 'i', $id);
                mysqli_stmt_execute($stmt_comments);
                $result_comments = mysqli_stmt_get_result($stmt_comments);

                $ip_data = []; // Array untuk menyimpan IP dan informasi terkait (username dan avatar)

                if (mysqli_num_rows($result_comments) > 0):
                    while ($comment_row = mysqli_fetch_assoc($result_comments)):
                        $ip_sender = $comment_row['IP_Sender'];
                        $content = htmlspecialchars($comment_row['content']);
                        $created_at = new DateTime($comment_row['created_at']);
                        $formatted_time = $created_at->format('l, d F Y') . ' | <i class="bi bi-clock"></i> ' . $created_at->format('H:i');

                        // Jika IP belum ada, buat data baru
                        if (!isset($ip_data[$ip_sender])) {
                            // Generate random username dan avatar
                            $random_avatar_number = rand(1, 10);
                            $random_username = 'user' . rand(10000, 99999);

                            // Simpan data ke array
                            $ip_data[$ip_sender] = [
                                'username' => $random_username,
                                'avatar' => "src/avatar ({$random_avatar_number}).png"
                            ];
                        }

                        // Ambil username dan avatar dari array
                        $username = $ip_data[$ip_sender]['username'];
                        $avatar_image = $ip_data[$ip_sender]['avatar'];
                        ?>
                        <div class="mx-auto flex justify-items-center">
                            <img alt="Profile Image" src="<?php echo $avatar_image; ?>" class="w-12 h-12 rounded-full bg-gray-300 mr-4">
                            <div>
                                <p class="font-bold"><?php echo $username; ?></p>

                                <p class="text-sm text-gray-500 m-1">
                                    <time datetime="<?php echo $created_at->format('c'); ?>">
                                        <?php echo $formatted_time; ?>
                                    </time>
                                </p>

                                <p class="text-black w-full border-b-2 mb-4"><?php echo $content; ?></p>
                            </div>
                        </div>
                        <?php
                    endwhile;
                else:
                    ?>
                    <p class="text-gray-600">No comments yet. Be the first to comment!</p>
                    <?php
                endif;
            else:
                ?>
                <p class="text-gray-600">The sender does not allow comments on this post.</p>
                <?php
            endif;
            ?>
        </div>
    </div>
</section>


  <?php
  include 'footer.php';
  ?>
  <!-- Tambahkan html2canvas -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script>
    document.getElementById('download-btn').addEventListener('click', function () {
      const element = document.getElementById('menfess-detail');

      // Gunakan html2canvas untuk menangkap elemen
      html2canvas(element).then(canvas => {
        // Konversi canvas ke gambar PNG
        const dataURL = canvas.toDataURL('image/png');

        // Buat elemen <a> untuk download
        const a = document.createElement('a');
        a.href = dataURL;
        a.download = 'menfess-detail.png';
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
      });
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

  <!-- JavaScript for Toggle Navbar -->
  <script>
    const navToggle = document.getElementById('navToggle');
    const navMenuMobile = document.getElementById('navMenuMobile');

    navToggle.addEventListener('click', () => {
      navMenuMobile.classList.toggle('hidden');
    });
  </script>

  <script>
    // Fungsi untuk menampilkan modal
    function showModal() {
      const modal = document.getElementById('modalBackground');
      modal.classList.remove('hidden');
    }

    // Fungsi untuk menutup modal
    function closeModal() {
      const modal = document.getElementById('modalBackground');
      modal.classList.add('hidden');
    }

    // Mengecek URL untuk parameter success
    window.onload = function () {
      const urlParams = new URLSearchParams(window.location.search);
      const success = urlParams.get('success');

      // Jika success=true di URL, tampilkan modal
      if (success === 'true') {
        showModal();
      }
    };

    // Event listener untuk menutup modal
    document.getElementById('closeModal').addEventListener('click', closeModal);
  </script>

</body>

</html>